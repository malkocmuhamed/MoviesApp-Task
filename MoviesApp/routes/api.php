<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::post('/password/reset', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/register', 'Auth\RegisterController@register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/register', 'RegisterController@showRegistrationForm');
    Route::get('/users', 'UsersController@index');
    Route::resource('movies', MoviesController::class);
    Route::resource('users', UsersController::class);
});

Route::middleware(['auth', 'role:' . 1])->group(function () {
    Route::get('/movies', 'MoviesController@indexUser')->name('movies.index');
    Route::post('/movies', [MoviesController::class, 'store'])->name('movies.store');
    Route::put('/movies/{id}', [MoviesController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{id}', [MoviesController::class, 'destroy'])->name('movies.destroy');
    Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'role:' . 2])->group(function () {
    Route::get('/movies', 'MoviesController@indexUser')->name('movies.index');
    Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
