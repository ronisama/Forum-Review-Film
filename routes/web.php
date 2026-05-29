<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboradController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('pages/home');
});
Route::get('/daftarfilm', function () {
    return view('pages/DaftarFilm');
});
Route::get('/artikelfilm', function () {
    return view('pages/ArtikelFilm');
});
// Route::get('/dashboard', function () {
//     return view('pages/DashboardUser');
// });
Route::get('/feeds', function () {
    return view('/pages/FeedsFilm');
});

//login register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboradController::class, 'index'])->middleware('auth');

//edit dashboard
Route::put('/dashboard/{id}', [DashboradController::class, 'update']);
