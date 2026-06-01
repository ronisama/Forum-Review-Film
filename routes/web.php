<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ThreadController;
use App\Models\Film;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('pages/home');
});
Route::get('/artikelfilm', function () {
    return view('pages/ArtikelFilm');
});
// Route::get('/dashboard', function () {
//     return view('pages/DashboardUser');
// });


//login register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboradController::class, 'index'])->middleware('auth');
Route::delete('/dashboard/{id}', [DashboradController::class, 'destroy'])->middleware('auth');
//edit dashboard
Route::put('/dashboard/{id}', [DashboradController::class, 'update']);


//daftar film
Route::get('/listFilm', [FilmController::class, 'daftarFilm'])->middleware('auth');
Route::get('/listFilm/{id}', [FilmController::class, 'show'])->middleware('auth');


//thread
Route::get('/feeds', [ThreadController::class, 'index'])->middleware('auth');
Route::get('/feeds/{id}', [ThreadController::class, ''])->middleware('auth');
