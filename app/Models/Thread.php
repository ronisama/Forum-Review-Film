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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}
