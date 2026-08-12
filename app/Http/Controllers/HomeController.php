<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->take(5)->get();
        $lastWeek = Carbon::now()->subDays(7);
        $trendingFilms = Film::with([
            'threads' => function ($q) use ($lastWeek) {
                $q->where('created_at', '>=', $lastWeek);
            },
            'threads.komentars' => function ($q) use ($lastWeek) {
                $q->where('created_at', '>=', $lastWeek);
            }
        ])->get();
        $trendingFilms = $trendingFilms->map(function ($film) {

            $threadCount = $film->threads->count();

            $commentCount = $film->threads->sum(function ($thread) {
                return $thread->komentars->count();
            });

            $film->trending_score =
                ($threadCount * 2)
                + $commentCount;

            return $film;
        });
        $trendingFilms = $trendingFilms
            ->sortByDesc('trending_score')
            ->take(10);

        return view('pages.home', [
            'trendingFilms' => $trendingFilms,
            'articles' => $articles
        ]);
    }
}
