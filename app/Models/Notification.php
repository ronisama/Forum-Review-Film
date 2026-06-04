<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'pengirim_id',
        'thread_id',
        'komentar_id',
        'tipe',
        'is_read',
        'pesan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function komentars()
    {
        return $this->belongsTo(Komentar::class);
    }
}
