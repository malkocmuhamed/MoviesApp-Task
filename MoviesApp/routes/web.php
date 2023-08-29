<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ReviewController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/movies', [MoviesController::class, 'index'])->name('movies.index');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth', 'role:' . 1])->group(function () {
    Route::get('/movies', [MoviesController::class, 'index'])->name('movies.index');
    Route::get('/movies/create', [MoviesController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MoviesController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}/edit', [MoviesController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{id}', [MoviesController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{id}', [MoviesController::class, 'destroy'])->name('movies.destroy');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});


Route::middleware(['auth', 'role:' . 2])->group(function () {
    Route::get('/movies', [MoviesController::class, 'indexUser'])->name('movies.index');
    Route::get('/movies/{slug}', [MoviesController::class, 'show'])->name('movies.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

