<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewsController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root to /home
Route::redirect('/', '/home');

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// News
Route::controller(NewsController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/news/create-post', 'showCreationForm')->middleware('auth');
    Route::get('/news/{news_post}', 'show')->middleware('auth');
    Route::post('/news', 'store');
    Route::put('/news/{news_post}', 'store');
    Route::delete('/news/{news_post}', 'destroy');
});

// Votes
Route::controller(VoteController::class)->group(function () {
    Route::post('/vote', 'store')->middleware('auth')->name('vote.store');
});

// Profile TODO
Route::controller(UserController::class)->group(function () {
    Route::get('/me', 'me')->middleware('auth');
    Route::get('/users/{user}', 'show');
});

Route::get('/file/upload', [FileController::class, 'index']); // TODO:: delete
Route::post('/file/upload', [FileController::class, 'upload']);