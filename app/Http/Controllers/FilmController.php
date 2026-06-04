<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Film;
use App\Models\Thread;
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
        $film = Film::findOrFail($id);

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
            $director = collect($credits['crew'])
                ->firstWhere('job', 'Director');

            $videos = Http::get(
                "https://api.themoviedb.org/3/movie/{$film->tmdb_id}/videos",
                [
                    'api_key' => env('TMDB_API_KEY')
                ]
            )->json();
            $recommendations = Http::get(
                "https://api.themoviedb.org/3/movie/{$film->tmdb_id}/recommendations",
                [
                    'api_key' => env('TMDB_API_KEY'),
                    'language' => 'id-ID'
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
                'recommendations' => $recommendations
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
    public function daftarFilm()
    {
        $films = Film::all();

        return view('pages.DaftarFilm', compact('films'));
    }
}
