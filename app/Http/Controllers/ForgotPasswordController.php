<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        $films = Film::latest()->take(5)->get();

        return view('pages.LupaPassword', compact('films'));
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (!$user) {
            return back()->with(
                'error',
                'Email tidak ditemukan'
            );
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')
            ->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => $token,
                    'created_at' => now()
                ]
            );

        $link = url('/reset-password/' . $token);

        Mail::raw(
            "Klik link berikut untuk reset password:\n\n$link",
            function ($message) use ($user) {
                $message
                    ->to($user->email)
                    ->subject('Reset Password');
            }
        );

        return back()->with(
            'success',
            'Link reset telah dikirim'
        );
    }
}
