<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

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
Route::redirect('/home', '/news/recent-feed');

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->middleware('auth')->name('logout');
});

// Register
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// News
Route::controller(NewsPostController::class)->group(function () {
    Route::get('/news/my-feed', 'myFeed')->middleware('auth')->name('news.my');
    Route::get('/news/top-feed', 'topFeed')->name('news.top');
    Route::get('/news/recent-feed', 'recentFeed')->name('news.recent');

    Route::get('/news/create-post', 'showCreationForm')->middleware('auth')->name('news.create');
    Route::get('/news/{news_post}', 'show')->name('news.show');
    Route::get('/news/{news_post}/comment/{comment}', 'showSingleThread');
    Route::post('/news', 'store')->middleware('auth')->name('news');
    Route::put('/news/{news_post}', 'update')->middleware('auth')->name('news.update');
    Route::delete('/news/{news_post}', 'destroy')->middleware('auth');
});

// Comments
Route::prefix('comments')->middleware('auth')->controller(CommentsController::class)->group(function () {
    Route::post('/', 'store');
    Route::put('/{comment}', 'update');
    Route::delete('/{comment}', 'destroy');
});

// Votes
Route::prefix('vote')->middleware('auth')->controller(VoteController::class)->group(function () {
    Route::post('/', 'store')->name('vote.store');
    Route::put('/{vote}', 'update')->name('vote.update');
    Route::delete('/{vote}', 'destroy')->name('vote.destroy');
});

// User
Route::controller(UserController::class)->group(function () {
    Route::get('/users/{user}/posts', 'showUserPosts')->middleware('auth')->name('user.posts');
    Route::get('/users/{user}/upvotes', 'showUserUpvotes')->middleware('auth')->name('user.upvotes');
    Route::get('/users/{user}/edit', 'showEditForm')->middleware('auth')->name('user.edit');
    Route::put('/users/{user}', 'update')->middleware('auth')->name('user.update');

    // Follow
    Route::post('/users/{user}/follow', 'follow')->middleware('auth')->name('users.follow');
    Route::delete('/users/{user}/unfollow', 'unfollow')->middleware('auth')->name('users.unfollow');
    Route::get('users/{user}/followers', 'showFollowers')->middleware('auth')->name('users.followers');
    Route::get('users/{user}/following', 'showFollowing')->middleware('auth')->name('users.following');
    Route::get('api/users/{user}/followers', 'getFollowers')->middleware('auth');
    Route::get('api/users/{user}/following', 'getFollowing')->middleware('auth');
});

// Admin
Route::prefix('admin')->middleware('admin')->controller(AdminController::class)->group(function () {
    Route::get('/', 'showAdmin')->name('admin');
    Route::get('/users/{user}/edit', 'showEditFormAdmin');
    Route::get('/users/create', 'showCreateFormAdmin');
    Route::post('/register', 'registerByAdmin');
});

// Search
Route::controller(SearchController::class)->group(function () {
    Route::get('/search/tags/{search}', 'searchTag');
    Route::get('/search/posts/{search}', 'searchPost');

    Route::get('api/search/users', 'searchUser')->middleware('admin');
    Route::get('api/search/users/{search}', 'searchUser')->middleware('admin');

    Route::get('api/search/{search}', 'search');
});
