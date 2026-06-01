<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {

        return view('pages.ArtikelFilm', [
            'artikel' => Artikel::all()
        ]);
    }
}
