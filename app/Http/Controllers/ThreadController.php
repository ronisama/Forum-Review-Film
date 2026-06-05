<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Komentar;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Genre;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.FeedsFilm', [
            'films' => Film::all(),
            'threads' => Thread::with(['user', 'film'])
                ->latest()
                ->paginate(5)
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

        if ($thread->user_id != Auth::id()) {
            abort(403);
        }

        $thread->delete();

        return back()->with(
            'success',
            'Thread berhasil dihapus'
        );
    }
}
