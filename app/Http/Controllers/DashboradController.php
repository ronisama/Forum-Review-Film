<?php

namespace App\Http\Controllers;

use App\Models\Thread;
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

        return view(
            'pages/DashboardUser',
            [
                'userGenres' => Auth::user()
                    ->genres()
                    ->orderByPivot('score', 'desc')
                    ->get(),
                'user' => Auth::user(),
                'threads' => Thread::with('film')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get()
            ]
        );
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


    // public function deleteThread(string $id)
    // {
    //     $user = User::findorFail($id);


    // }

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
        // Validasi data input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id . ',id',
            'password' => 'nullable|min:8|max:16|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'foto_profil.max' => 'Foto profil maksimal 2 MB.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto_profil.uploaded' => 'Foto profil gagal diupload. Maksimal 2 MB',
        ]);
        //upload foto profil
        if ($request->hasFile('foto_profil')) {

            $file = $request->file('foto_profil');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images'), $filename);

            $user->foto_profil = $filename;
        }
        if ($request->hapus_foto) {

            $path = public_path('images/' . $user->foto_profil);

            if (file_exists($path)) {
                unlink($path);
            }

            $user->foto_profil = null;
        }


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
