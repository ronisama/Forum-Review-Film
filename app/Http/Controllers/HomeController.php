<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Film;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $films = Film::latest()->take(10)->get();
        $articles = Article::latest()->take(5)->get();

        return view('pages.home', compact('films', 'articles'));
    }
}
