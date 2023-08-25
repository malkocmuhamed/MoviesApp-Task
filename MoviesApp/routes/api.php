<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::post('/password/reset', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset/{token}', 'Auth\ResetPasswordController@reset');
    // Route::post('/users', 'UsersController@store');
    // Route::get('/users', 'UsersController@index');
});

// Route::namespace('Auth')->group(function () {
//     Route::get('/register', 'RegisterController@showRegistrationForm');
//     Route::post('/register', 'RegisterController@register');
// });
Route::post('/register', 'Auth\RegisterController@register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/register', 'RegisterController@showRegistrationForm');
    Route::post('/users', 'UsersController@store');
    Route::get('/users', 'UsersController@index');
    Route::resource('movies', MoviesController::class);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
