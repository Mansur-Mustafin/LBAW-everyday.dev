<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSettingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagProposalController;
use Illuminate\Support\Facades\Route;

// use Illuminate\Support\Facades\Broadcast;

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

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

Route::prefix('news')->controller(FeedController::class)->group(function ()  {
    Route::get('/my-feed', 'myFeed')->middleware('auth')->name('news.my');
    Route::get('/top-feed', 'topFeed')->name('news.top');
    Route::get('/recent-feed', 'recentFeed')->name('news.recent');
    Route::get('/bookmarks', 'bookmarksFeed')->middleware('auth')->name('news.bookmarks');
});

Route::prefix('news')->controller(NewsPostController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/create-post', 'showCreationForm')->name('news.create');
        Route::post('/', 'store')->name('news');
        Route::put('/{news_post}', 'update')->name('news.update');
        Route::delete('/{news_post}', 'destroy');
    });
    Route::get('/{news_post}', 'show')->name('news.show');
    Route::get('/{news_post}/comment/{comment}', 'showSingleThread');
});

Route::prefix('comments')->middleware('auth')->controller(CommentsController::class)->group(function () {
    //TODO: Route::resource('/', CommentsController::class)->only('store', 'update', 'destroy'); 
    Route::post('/', 'store');
    Route::put('/{comment}', 'update');
    Route::delete('/{comment}', 'destroy');
});

Route::prefix('vote')->middleware('auth')->controller(VoteController::class)->group(function () {
    Route::post('/', 'store')->name('vote.store');
    Route::put('/{vote}', 'update')->name('vote.update');
    Route::delete('/{vote}', 'destroy')->name('vote.destroy');
});

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('/users/{user}/posts', 'showUserPosts')->name('user.posts');
    Route::get('/users/{user}/upvotes', 'showUserUpvotes')->name('user.upvotes');
    Route::get('/users/{user}/edit', 'showEditForm')->name('user.edit');
    Route::put('/users/{user}', 'update')->name('user.update');
});

Route::middleware('auth')->controller(FollowController::class)->group(function () {
    Route::post('/users/{user}/follow', 'followUser')->name('users.follow');
    Route::delete('/users/{user}/unfollow', 'unfollowUser')->name('users.unfollow');
    Route::get('users/{user}/followers', 'showFollowers')->name('users.followers');
    Route::get('users/{user}/following', 'showFollowing')->name('users.following');
    Route::get('api/users/{user}/followers', 'getFollowers');
    Route::get('api/users/{user}/following', 'getFollowing');

});

Route::middleware('auth')->controller(TagController::class)->group(function () {
    Route::post('tag/store/{tag}','store')->middleware('auth')->name('user.follow_tag');
    Route::delete('tag/delete/{tag}','delete')->middleware('auth')->name('user.unfollow_tag');
    Route::get('api/tags', 'getFollowingTags')->middleware('auth');
    Route::get('api/tags/all','getTags');
});

Route::prefix('admin')->middleware('admin')->controller(AdminController::class)->group(function () {
    // Users
    Route::get('/', 'showUsers')->name('admin');
    Route::get('/users','showUsers');
    Route::get('/users/{user}/edit', 'showEditForm');
    Route::get('/users/create', 'showCreateForm');
    Route::post('/register', 'register');
    Route::put('/{user}', 'update')->name('admin.update');

    // Tags
    Route::post('/tags/create','createTag');
    Route::delete('/tags/delete/{tag}','deleteTag');
    Route::get('/tags','showTags')->name('admin.tags');
    Route::get('/tags','showTags')->name('admin.tags');
    Route::get('/tags/create','showCreateTagForm');

    // Tag Proposals
    Route::get('/tag_proposals','showTagProposals');
    Route::put('/tag_proposals/update/{tag_proposal}','updateTagProposal');
    Route::delete('/tag_proposals/delete/{tag_proposal}','deleteTagProposal');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('api/search/tags','searchTags');
    Route::get('api/search/tags/{search}','searchTags');

    Route::get('api/search/tag_proposals','searchTagProposals');
    Route::get('api/search/tag_proposals/{search}','searchTagProposals');

    Route::get('/search/posts/tags/','searchTagPosts');
    Route::get('/search/posts/tags/{search}', 'searchTagPosts');
    Route::get('/search/posts/{search}', 'searchPost');

    Route::get('api/search/users', 'searchUser')->middleware('admin');
    Route::get('api/search/users/{search}', 'searchUser')->middleware('admin');


    Route::get('api/search/{search}', 'search');
});

Route::prefix('file')->middleware('auth')->controller(FileController::class)->group(function () {
    Route::post('/upload', 'uploadAjax');
    Route::delete('/delete', 'deleteAjax');
});

Route::prefix('bookmark')->middleware('auth')->controller(BookmarkController::class)->group(function () {
    Route::post('/', 'store')->name('bookmark.store');
    Route::delete('/{post}', 'destroy')->name('bookmark.destroy');
});

Route::middleware('auth')->controller(TagProposalController::class)->group(function () {
    Route::get('tag_proposal/create','showCreationForm');
    Route::post('tag_proposals/create','store');
    Route::get('/api/tag_proposals','show');
    Route::get('/api/tag_proposals/all','showAll');
});

Route::middleware('auth')->controller(NotificationController::class)->group(function () {
    Route::get('/notifications', 'index')->name('notifications.index');
    Route::get('/api/notifications', 'getNotifications')->name('notifications.get');
});

Route::middleware('auth')->controller(NotificationSettingController::class)->group(function () {
    Route::put('/notification-settings', 'update');
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/call-back', 'callbackGoogle')->name('google-call-back');
});
