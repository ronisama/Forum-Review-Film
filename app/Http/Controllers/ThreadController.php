<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Komentar;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Pagination\LengthAwarePaginator;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userGenres = Auth::user()
            ->genres
            ->pluck('pivot.score', 'id');

        $recommendedThreads = Thread::with([
            'user',
            'film.genres'
        ])
            ->get();
        $tab = request('tab', 'recommend');
        foreach ($recommendedThreads as $thread) {

            $dotProduct = 0;
            $userMagnitude = 0;
            $threadMagnitude = 0;

            foreach ($userGenres as $genreId => $score) {

                $userMagnitude += pow($score, 2);

                $threadHasGenre = $thread
                    ->film
                    ->genres
                    ->contains('id', $genreId)
                    ? 1
                    : 0;

                $dotProduct += $score * $threadHasGenre;

                $threadMagnitude += pow(
                    $threadHasGenre,
                    2
                );
            }

            $userMagnitude = sqrt($userMagnitude);
            $threadMagnitude = sqrt($threadMagnitude);

            $thread->similarity =
                ($userMagnitude > 0 && $threadMagnitude > 0)
                ? $dotProduct / ($userMagnitude * $threadMagnitude)
                : 0;
            $freshnessScore = $thread->created_at->timestamp / time();

            $thread->finalScore =
                ($thread->similarity * 0.8)
                +
                ($freshnessScore * 0.2);
        }

        $recommendedThreads = $recommendedThreads
            ->sortByDesc('finalScore')
            ->values();
        $currentPage = request()->get('page', 1);

        $perPage = 4;

        $recommendedThreads = new LengthAwarePaginator(
            $recommendedThreads->forPage($currentPage, $perPage),
            $recommendedThreads->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url()
            ]
        );
        $latestThreads = Thread::with([
            'user',
            'film'
        ])
            ->latest()
            ->paginate(5);
        return view('pages.FeedsFilm', [
            'tab' => $tab,
            'userGenres' => $userGenres,
            'films' => Film::all(),
            'recommendedThreads' => $recommendedThreads,
            'latestThreads' => $latestThreads
        ]);
    }

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
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id',
            'isi_thread' => 'required'
        ]);

        $thread = Thread::create([
            'isi_thread' => $validated['isi_thread'],
            'film_id' => $validated['film_id'],
            'user_id' => Auth::id()
        ]);

        $film = Film::with('genres')
            ->find($validated['film_id']);

        foreach ($film->genres as $genre) {

            $userGenre = Auth::user()
                ->genres()
                ->where('genre_id', $genre->id)
                ->first();

            if ($userGenre) {

                Auth::user()
                    ->genres()
                    ->updateExistingPivot(
                        $genre->id,
                        [
                            'score' =>
                            $userGenre->pivot->score + 5
                        ]
                    );
            } else {

                Auth::user()
                    ->genres()
                    ->attach(
                        $genre->id,
                        [
                            'score' => 5
                        ]
                    );
            }
        }

        return redirect('/feeds');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $thread = Thread::with([
            'user',
            'film'
        ])->findOrFail($id);

        $komentars = Komentar::with([
            'user',
            'replies.user'
        ])
            ->where('thread_id', $thread->id)
            ->whereNull('parent_id')
            ->latest()
            ->paginate(10);

        return view('pages.DetailThread', [
            'thread' => $thread,
            'komentars' => $komentars
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
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
        $thread = Thread::findOrFail($id);

        if (
            $thread->user_id != Auth::id()
            && Auth::user()->role !== 'admin'
        ) {
            abort(403);
        }

        $thread->delete();

        return back()->with(
            'success',
            'Thread berhasil dihapus'
        );
    }
}
