<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChurchController;
use App\Http\Controllers\Api\ParticipantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

//Participants
Route::post('/youthweek/participants', [ParticipantController::class, "store"]);
Route::post('/youthweek/church-participants', [ParticipantController::class, "registerAsChurch"]);

//CHURCHES
Route::get('/youthweek/churches', [ChurchController::class, "index"]);
Route::post('/youthweek/churches', [ChurchController::class, "store"]);

// Route::apiResource('/youthweek/participants', ParticipantController::class);
// Route::apiResource('/youthweek/churches', ChurchController::class);

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);
        
        // Route::apiResource('participants', ParticipantController::class);
        Route::get('/youthweek/participants', [ParticipantController::class, "index"]);
        Route::post('/youthweek/participants/{participant}', [ParticipantController::class, "update"]);
        Route::post('/youthweek/participants/{participant}', [ParticipantController::class, "destroy"]);
        
        // Route::apiResource('churches', ChurchController::class);
        Route::post('/youthweek/churches/{church}', [ChurchController::class, "update"]);
        Route::post('/youthweek/churches/{church}', [ChurchController::class, "destroy"]);
    });
