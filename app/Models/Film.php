<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
