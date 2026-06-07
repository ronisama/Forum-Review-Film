<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminFilmController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\Artikel;
use App\Models\Film;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

Route::get('/', [HomeController::class, 'index']);
// Route::get('/artikelfilm', function () {
//     return view('pages/ArtikelFilm');
// });
// Route::get('/dashboard', function () {
//     return view('pages/DashboardUser');
// });


//login register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);
//dasboard 
Route::get('/dashboard', [DashboradController::class, 'index'])->middleware('auth');
Route::delete('/dashboard/{id}', [DashboradController::class, 'destroy'])->middleware('auth');
//edit dashboard
Route::put('/dashboard/{id}', [DashboradController::class, 'update']);
//hapus threads di dashboard
Route::delete('/feeds/{id}', [ThreadController::class, 'destroy']);


//daftar film
Route::get('/listFilm', [FilmController::class, 'daftarFilm'])->middleware('auth');
Route::get('/listFilm/{id}', [FilmController::class, 'show'])->middleware('auth');


//thread
Route::get('/feeds', [ThreadController::class, 'index'])->middleware('auth');
Route::post('/feeds', [ThreadController::class, 'store'])->middleware('auth');
Route::get('/feeds/{id}', [ThreadController::class, 'show'])->middleware('auth');

//komentar
Route::post('/komentar', [KomentarController::class, 'store']);

//notif
Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth');

// user
Route::get('/user/{username}', [UserController::class, 'show']);


//admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/films/search', [AdminFilmController::class, 'searchForm']);
    Route::get('/admin/films/result', [AdminFilmController::class, 'search']);
    Route::post('/admin/films/store', [AdminFilmController::class, 'store']);

    //delete film
    Route::delete(
        '/films/{film}',
        [AdminFilmController::class, 'destroy']
    )->middleware(['auth', 'admin'])
        ->name('films.destroy');

    // artikel untuk admin
    Route::get(
        '/admin/articles/tambah',
        [AdminArticleController::class, 'create']
    )->name('articles.create');

    Route::post(
        '/admin/articles',
        [AdminArticleController::class, 'store']
    )->name('articles.store');
});

// artikel
Route::get(
    '/articles',
    [ArticleController::class, 'index']
)->name('articles.index');

Route::get(
    '/articles/{article}',
    [ArticleController::class, 'show']
)->name('articles.show');


// reset password
Route::get('/test-email', function () {

    Mail::raw(
        'Halo, ini email percobaan dari Laravel.',
        function ($message) {
            $message->to('firgigastempurung@gmail.com')
                ->subject('Test Email Laravel');
        }
    );

    return 'Email berhasil dikirim!';
});


//lupa password
Route::get(
    '/forgot-password',
    [ForgotPasswordController::class, 'showForm']
)->name('password.request');

Route::post(
    '/forgot-password',
    [ForgotPasswordController::class, 'sendResetLink']
)->name('password.email');

Route::get(
    '/reset-password/{token}',
    [ResetPasswordController::class, 'showForm']
)->name('password.reset');

Route::post(
    '/reset-password',
    [ResetPasswordController::class, 'reset']
)->name('password.update');
