<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/movies', [MoviesController::class, 'index'])->name('movies.index');

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
});

