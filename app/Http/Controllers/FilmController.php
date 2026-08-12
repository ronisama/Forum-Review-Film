<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Film;
use App\Models\Thread;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Film::with('genres')->findOrFail($id);

        $threads = Thread::with('user')
            ->where('film_id', $film->id)
            ->latest()
            ->paginate(10);

        $tmdb = null;

        if ($film->tmdb_id) {

            $response = Http::get(
                "https://api.themoviedb.org/3/movie/{$film->tmdb_id}",
                [
                    'api_key' => env('TMDB_API_KEY'),
                    'language' => 'id-ID'
                ]
            );

            if ($response->successful()) {
                $tmdb = $response->json();
            }
            $credits = Http::get(
                "https://api.themoviedb.org/3/movie/{$film->tmdb_id}/credits",
                [
                    'api_key' => env('TMDB_API_KEY')
                ]
            )->json();
            $director = collect($credits['crew'] ?? [])
                ->firstWhere('job', 'Director')['name'] ?? null;

            $videos = Http::get(
                "https://api.themoviedb.org/3/movie/{$film->tmdb_id}/videos",
                [
                    'api_key' => env('TMDB_API_KEY')
                ]
            )->json();
            $trailer = collect($videos['results'])
                ->first(function ($video) {
                    return $video['site'] === 'YouTube'
                        && $video['type'] === 'Trailer';
                });
            return view('pages.DetailFilm', [
                'film' => $film,
                'threads' => $threads,
                'tmdb' => $tmdb,
                'credits' => $credits,
                'director' => $director,
                'trailer' => $trailer,
            ]);
        }
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function daftarFilm(Request $request)
    {
        $query = Film::query();
        $genre = request('genre_radio') ?: request('genre_select');
        // Search
        if ($request->filled('search')) {

            $query->where(
                'nama_film',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Filter Genre
        if ($genre) {

            $query->whereHas(
                'genres',
                function ($q) use ($genre) {

                    $q->where(
                        'genres.id',
                        request('genre_radio') ?:
                            request('genre_select')
                    );
                }
            );
        }

        $films = $query
            ->latest()
            ->paginate(24);
        $suggestions = collect();
        if (
            $request->filled('search')
            && $films->total() == 0
        ) {

            $suggestions = Film::select('id', 'nama_film')->get()

                ->map(function ($film) use ($request) {

                    similar_text(
                        strtolower($request->search),
                        strtolower($film->nama_film),
                        $percent
                    );

                    return [
                        'film' => $film,
                        'similarity' => $percent
                    ];
                })

                ->sortByDesc('similarity')

                ->take(5);
        }

        $genres = Genre::orderBy('genre')
            ->get();

        return view(
            'pages.DaftarFilm',
            compact('films', 'genres', 'suggestions')
        );
    }
}
