<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function destroyUser(User $user)
    {
        if ($user->role === 'admin') {

            return back()->with(
                'error',
                'Admin tidak dapat dihapus.'
            );
        }

        if ($user->id === Auth::id()) {

            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun sendiri.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'User berhasil dihapus.'
        );
    }
}
