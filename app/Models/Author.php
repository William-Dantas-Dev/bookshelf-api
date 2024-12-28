<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'biography',
        'birthDate',
        'deathDate',
    ];

    protected $casts = [
        'birthDate' => 'date:Y-m-d',
        'deathDate' => 'date:Y-m-d',
    ];
}
