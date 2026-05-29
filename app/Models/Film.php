<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    public function daftarFilm()
    {
        $films = Film::all();

        return view('pages.DaftarFilm', [
            'films' => $films
        ]);
    }
}
