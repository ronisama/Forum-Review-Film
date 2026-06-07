<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showForm($token)
    {
        return view(
            'pages.ResetPassword',
            [
                'token' => $token
            ]
        );
    }
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->with(
                'error',
                'Token tidak valid'
            );
        }

        User::where(
            'email',
            $record->email
        )->update([
            'password' => Hash::make(
                $request->password
            )
        ]);

        DB::table('password_reset_tokens')
            ->where('email', $record->email)
            ->delete();

        return redirect('/login')
            ->with(
                'success',
                'Password berhasil diubah'
            );
    }
}
