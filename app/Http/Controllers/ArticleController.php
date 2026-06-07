<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Film;
use App\Models\ArticleCategory;

class ArticleController extends Controller
{
    public function index()
    {

        $query = Article::with('categories');

        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%');
        }

        if (request('category')) {
            $query->whereHas('categories', function ($q) {
                $q->where('article_categories.id', request('category'));
            });
        }

        return view('pages.ArtikelFilm', [
            'articles' => $query->latest()->paginate(5),
            'categories' => ArticleCategory::all(),
        ]);
    }
    public function show(Article $article)
    {
        $relatedArticles = Article::whereHas(
            'categories',
            function ($query) use ($article) {

                $query->whereIn(
                    'article_categories.id',
                    $article
                        ->categories
                        ->pluck('id')
                );
            }
        )
            ->where('id', '!=', $article->id)
            ->take(4)
            ->get();

        $trendingFilms = Film::withCount('threads')
            ->orderByDesc('threads_count')
            ->take(5)
            ->get();

        return view(
            'pages.ArtikelDetail',
            [
                'article' => $article,
                'relatedArticles' => $relatedArticles,
                'trendingFilms' => $trendingFilms
            ]
        );
    }
}
