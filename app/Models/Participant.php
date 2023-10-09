<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'church_id',
        'name',
        'email',
        'phone',
        'type',
        'group',
        'gender',
        'image',
    ];

    protected $searchableFields = ['*'];

    public static function getNext($last) {
        switch ($last) {
            case 1:
                # code...
                return 2;
            case 2:
                return 3;
            case 3:
                return 1;
            default:
                # code...
                return 1;
                break;
        }
    }
}
