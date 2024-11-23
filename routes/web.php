<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
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
    Route::get('/home', 'recent_feed')->name('home');
    Route::get('/news/my-feed','my_feed')->middleware('auth');
    Route::get('/news/top-feed','top_feed');
    Route::get('/news/recent-feed','recent_feed');

    Route::get('/news/create-post', 'showCreationForm')->middleware('auth')->name('create');
    Route::get('/news/{news_post}', 'show');
    Route::post('/news', 'store')->middleware('auth')->name('news');
    Route::put('/news/{news_post}', 'store')->middleware('auth');
    Route::delete('/news/{news_post}', 'destroy')->middleware('auth');
});

// Votes
Route::controller(VoteController::class)->group(function () {
    Route::post('/vote', 'store')->middleware('auth')->name('vote.store');
    Route::delete('/vote/{vote}', 'destroy')->middleware('auth')->name('vote.destroy');
    Route::put('/vote/{vote}', 'update')->middleware('auth')->name('vote.update');
});

// Profile
Route::controller(UserController::class)->group(function () {
    Route::get('/users/{user}/posts', 'showUserPosts')->middleware('auth')->name('user.posts');
    Route::get('/users/{user}/upvotes', 'showUserUpvotes')->middleware('auth')->name('user.upvotes');
    Route::get('/users/{user}/edit', 'showEditForm')->middleware('auth')->name('user.edit');
    Route::put('/users/{user}', 'update')->middleware('auth')->name('user.update');
});

// Search
Route::controller(SearchController::class)->group(function () {
    Route::get('/search/tags/{search}','search_tag');
    Route::get('/search/posts/{search}','search_post');
    Route::get('/search/{search}','search');
});
