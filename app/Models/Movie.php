<?php

namespace App\Models;

use App\Services\OpenAiService;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'genre',
        'director',
        'poster_url',
        'release_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
