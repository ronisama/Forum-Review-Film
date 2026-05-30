<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'judul_thread',
        'isi_thread',
        'user_id',
        'film_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}
