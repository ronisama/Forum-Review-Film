<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
                ->get()
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
            'judul_thread' => 'required|max:255',
            'isi_thread' => 'required'
        ]);

        Thread::create([
            'judul_thread' => $validated['judul_thread'],
            'isi_thread' => $validated['isi_thread'],
            'film_id' => $validated['film_id'],
            'user_id' => Auth::id()
        ]);

        return redirect('/feeds');
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
    public function destroy(string $id)
    {
        //
    }
}
