<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        Komentar::create([
            'isi_komentars' => $validated['isi_komentars'],
            'thread_id' => $validated['thread_id'],
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id
        ]);

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
    public function destroy(string $id)
    {
        //
    }
}
