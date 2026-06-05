<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Genre;

class AdminFilmController extends Controller
{
    public function searchForm()
    {
        return view('pages.adminFilmSearch');
    }

    public function search(Request $request)
    {
        $query = $request->keyword;

        $response = Http::get(
            'https://api.themoviedb.org/3/search/multi',
            [
                'api_key' => env('TMDB_API_KEY'),
                'query' => $query,
                'language' => 'id-ID'
            ]
        );

        return view('pages.adminFilmSearch', [
            'results' => $response->json()['results'] ?? []
        ]);
    }

    public function store(Request $request)
    {
        $detail = Http::get(
            "https://api.themoviedb.org/3/{$request->type}/{$request->tmdb_id}",
            [
                'api_key' => env('TMDB_API_KEY'),
                'language' => 'id-ID'
            ]
        )->json();

        $credits = Http::get(
            "https://api.themoviedb.org/3/{$request->type}/{$request->tmdb_id}/credits",
            [
                'api_key' => env('TMDB_API_KEY')
            ]
        )->json();

        $director = null;

        // Prioritas 1: Director
        if (isset($credits['crew'])) {

            foreach ($credits['crew'] as $crew) {

                if ($crew['job'] === 'Director') {

                    $director = $crew['name'];
                    break;
                }
            }
        }

        // Prioritas 2: Creator
        if (!$director && !empty($detail['created_by'])) {

            $director = collect($detail['created_by'])
                ->pluck('name')
                ->implode(', ');
        }

        // Prioritas 3: Executive Producer
        if (!$director && isset($credits['crew'])) {

            foreach ($credits['crew'] as $crew) {

                if ($crew['job'] === 'Executive Producer') {

                    $director = $crew['name'];
                    break;
                }
            }
        }

        $film = Film::updateOrCreate(
            [
                'tmdb_id' => $request->tmdb_id
            ],
            [
                'nama_film' => $detail['title']
                    ?? $detail['name']
                    ?? 'Tanpa Judul',

                'sinopsis' => $detail['overview'] ?? null,

                'release_year' => substr(
                    $detail['release_date']
                        ?? $detail['first_air_date']
                        ?? '',
                    0,
                    4
                ),

                'poster' => $detail['poster_path'] ?? null,

                'rating' => $detail['vote_average'] ?? null,

                'director' => $director,

                'type' => $request->type,

                'runtime' => $detail['runtime']
                    ?? ($detail['episode_run_time'][0] ?? null)
            ]
        );
        $genreIds = [];

        foreach ($detail['genres'] ?? [] as $genreData) {

            $genre = Genre::firstOrCreate(
                [
                    'genre' => $genreData['name']
                ]
            );

            $genreIds[] = $genre->id;
        }

        $film->genres()->sync($genreIds);

        return back()->with(
            'success',
            'Film berhasil ditambahkan'
        );
    }

    public function destroy(Film $film)
    {
        $film->delete();

        return back()->with(
            'success',
            'Film berhasil dihapus'
        );
    }
}
