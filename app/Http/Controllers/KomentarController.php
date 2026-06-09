<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Film;
use App\Models\Thread;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'isi_komentars' => 'required',
            'thread_id' => 'required|exists:threads,id'
        ]);

        $komentar = Komentar::create([
            'isi_komentars' => $validated['isi_komentars'],
            'thread_id' => $validated['thread_id'],
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id
        ]);

        preg_match_all(
            '/@([A-Za-z0-9_]+)/',
            $komentar->isi_komentars,
            $matches
        );

        foreach ($matches[1] as $username) {

            $mentionedUser = User::where(
                'username',
                $username
            )->first();

            if (
                $mentionedUser &&
                $mentionedUser->id != Auth::id()
            ) {

                Notification::create([
                    'user_id' => $mentionedUser->id,
                    'pengirim_id' => Auth::id(),
                    'thread_id' => $komentar->thread_id,
                    'komentar_id' => $komentar->id,
                    'tipe' => 'mention',
                    'pesan' => $komentar->isi_komentars
                ]);
            }
        }
        $thread = Thread::with('film.genres')
            ->find($validated['thread_id']);

        if ($thread && $thread->film) {
            foreach ($thread->film->genres as $genre) {
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
                                $userGenre->pivot->score + 2
                            ]
                        );
                } else {
                    Auth::user()
                        ->genres()
                        ->attach(
                            $genre->id,
                            [
                                'score' => 2
                            ]
                        );
                }
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Komentar $id)
    {
        if (
            $id->user_id != Auth::id()
            && Auth::user()->role !== 'admin'
        ) {
            abort(403);
        }

        $id->delete();

        return back()->with(
            'success',
            'Komentar berhasil dihapus'
        );
    }
}
