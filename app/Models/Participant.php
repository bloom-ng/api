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
    ];

    protected $searchableFields = ['*'];
}
