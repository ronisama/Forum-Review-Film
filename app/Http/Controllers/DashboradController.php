<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DashboradController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages/dashboardUser', [
            'user' => Auth::user()
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();
        if ($user->id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Tampilkan pesan akses ditolak
        }
        // Validasi password lama
        if (!Hash::check($request->password_lama, $user->password)) {

            return back()->withErrors([
                'password_lama' => 'Password lama salah'
            ]);
        }
        //upload foto profil
        if ($request->hasFile('foto_profil')) {

            $file = $request->file('foto_profil');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images'), $filename);

            $user->foto_profil = $filename;
        }
        // Validasi data input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id . ',id',
            'password' => 'nullable|min:8|max:16|confirmed',
        ]);

        // Update data pengguna
        $user->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
            'foto_profil' => $user->foto_profil
        ]);
        return redirect('/dashboard')->with('success', 'update success to execute!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = User::findorFail($id);

        if ($user->id !== Auth::id()) {
            abort(403);
        }

        if (!Hash::check($request->password,  $user->password)) {

            return back()->withErrors([
                'password' => 'Password salah'
            ]);
        }

        Auth::logout();


        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with(
            'success',
            'Akun Berhasil Dihapus'
        );
    }
}
