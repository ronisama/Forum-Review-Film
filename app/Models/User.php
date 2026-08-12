<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Genre;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $fillable = [
        'username',
        'email',
        'password',
        'foto_profil',
        'ketertarikan_genre'
    ];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function genres()
    {
        return $this->belongsToMany(
            Genre::class,
            'user_genre'
        )->withPivot('score');
    }
}
