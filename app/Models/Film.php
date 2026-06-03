<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'nama_film',
        'sinopsi',
        'release_year',
        'poster',
        'type'
    ];
    public function threads()
    {
        return $this->hasMany(Thread::class, 'film_id');
    }
    public function genres()
    {
        return $this->belongsToMany(
            Genre::class,
            'film_genre'
        );
    }
}
