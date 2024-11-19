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

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

// Register
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// News
Route::controller(NewsController::class)->group(function () {
    // Route::get('/news/page','index'); // Get news_post page
    Route::get('/home', 'recent_feed')->name('home');
    Route::get('/news/my-feed','my_feed')->middleware('auth');
    Route::get('/news/top-feed','top_feed');
    Route::get('/news/recent-feed','recent_feed');

    Route::get('/news/create-post', 'showCreationForm')->middleware('auth')->name('create');
    Route::get('/news/{news_post}', 'show')->middleware('auth');
    Route::post('/news', 'store')->name('news');
    Route::put('/news/{news_post}', 'store');
    Route::delete('/news/{news_post}', 'destroy');
});

// Votes
Route::controller(VoteController::class)->group(function () {
    Route::post('/vote', 'store')->name('vote.store');
    Route::delete('/vote/{vote}', 'destroy')->name('vote.destroy');
    Route::put('/vote/{vote}', 'update')->name('vote.update');
});

// Profile TODO
Route::controller(UserController::class)->group(function () {
    Route::get('/me', 'me')->middleware('auth');
    Route::get('/users/{user}', 'show');
});

// Files
Route::controller(FileController::class)->group(function() {
    Route::get('/file/upload', 'index'); // TODO:: delete
    Route::post('/file/upload', 'upload');
});

// Search
Route::controller(SearchController::class)->group(function () {
    Route::get('/search/posts','search_post');
    Route::get('/search/posts/{search}','search_post');
    Route::get('/search','search');
    Route::get('/search/{search}','search');
});
