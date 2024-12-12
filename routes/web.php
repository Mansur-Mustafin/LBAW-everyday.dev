<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordRecoverController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\BlockedController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSettingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagProposalController;
use App\Http\Controllers\UnblockAppealController;

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
Route::redirect('/', '/home')->name('home');
Route::redirect('/home', '/news/recent-feed');

Route::controller(BlockedController::class)->group(function () {
    Route::get('/blocked','show')->name('blocked');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->middleware(['auth'])->name('logout');
});

Route::controller(PasswordRecoverController::class)->group(function () {
    Route::get('/recover/form', 'showRecoverForm')->name('recover.form');
    Route::post('/recover', 'recover')->name('recover.update');
    Route::get('/recover', 'showResetPasswordForm')->name('recover.reset');
});

Route::controller(MailController::class)->group(function(){
    Route::post('/emailrecover', 'send')->name('email.recover');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

Route::prefix('news')->middleware('blocked')->controller(FeedController::class)->group(function ()  {
    Route::get('/my-feed', 'myFeed')->middleware('auth')->name('news.my');
    Route::get('/api/my-feed', 'getMyFeed')->name('api.news.my');

    Route::get('/recent-feed', 'recentFeed')->name('news.recent');
    Route::get('/api/recent-feed', 'getRecentFeed')->name('api.news.recent');

    Route::get('/bookmarks', 'bookmarkFeed')->middleware('auth')->name('news.bookmark');
    Route::get('/api/bookmarks', 'getBookmarkFeed')->middleware('auth')->name('api.news.bookmark');

    Route::get('/tags/{search}', 'tagFeed');
    Route::get('api/tags/{search}', 'getTagFeed')->name('api.tags.search');

    Route::get('/posts/{search}', 'postFeed');
    Route::get('api/posts/{search}', 'getPostFeed')->name('api.posts.search');
});

Route::prefix('news')->controller(NewsPostController::class)->group(function () {
    Route::middleware(['auth','blocked'])->group(function () {
        Route::get('/create-post', 'showCreationForm')->name('news.create');
        Route::post('/', 'store')->name('news');
        Route::put('/{news_post}', 'update')->name('news.update');
        Route::delete('/{news_post}', 'destroy');
    });
    Route::get('/{news_post}', 'show')->name('news.show');
    Route::get('/{news_post}/comment/{comment}', 'showSingleThread');
});

Route::prefix('comments')->middleware(['auth','blocked'])->controller(CommentsController::class)->group(function () {
    Route::post('/', 'store');
    Route::put('/{comment}', 'update');
    Route::delete('/{comment}', 'destroy');
});

Route::prefix('vote')->middleware(['auth','blocked'])->controller(VoteController::class)->group(function () {
    Route::post('/', 'store')->name('vote.store');
    Route::put('/{vote}', 'update')->name('vote.update');
    Route::delete('/{vote}', 'destroy')->name('vote.destroy');
});

Route::middleware(['auth','blocked'])->controller(UserController::class)->group(function () {
    Route::get('/users/{user}/posts', 'userPosts')->name('user.posts');
    Route::get('/api/users/{user}/posts', 'getUserPosts')->name('api.user.posts');

    Route::get('/users/{user}/upvotes', 'userUpvotes')->name('user.upvotes');
    Route::get('/api/users/{user}/upvotes', 'getUserUpvotes')->name('api.user.upvotes');

    Route::get('/users/{user}/edit', 'showEditForm')->name('user.edit');
    Route::put('/users/{user}', 'update')->name('user.update');
});

Route::middleware(['auth','blocked'])->controller(FollowController::class)->group(function () {
    Route::post('/users/{user}/follow', 'followUser')->name('users.follow');
    Route::delete('/users/{user}/unfollow', 'unfollowUser')->name('users.unfollow');
    Route::get('users/{user}/followers', 'showFollowers')->name('users.followers');
    Route::get('users/{user}/following', 'showFollowing')->name('users.following');
    Route::get('api/users/{user}/followers', 'getFollowers');
    Route::get('api/users/{user}/following', 'getFollowing');

});

Route::middleware(['auth','blocked'])->controller(TagController::class)->group(function () {
    Route::post('tag/store/{tag}','store')->name('user.follow_tag');
    Route::delete('tag/delete/{tag}','delete')->name('user.unfollow_tag');
    Route::get('api/tags', 'getFollowingTags');
    Route::get('api/tags/all','getTags');

    Route::post('admin/tags/create','store')->middleware('admin');
    Route::delete('admin/tags/delete/{tag}','destroy')->middleware('admin');
    Route::get('admin/tags','show')->name('admin.tags')->middleware('admin');
    Route::get('admin/tags/create','showCreationForm')->middleware('admin');
});

Route::prefix('admin')->middleware('admin')->controller(AdminController::class)->group(function () {
    // Users
    Route::get('/', 'showUsers')->name('admin');
    Route::get('/users','showUsers')->name('admin.users');
    Route::get('/users/{user}/edit', 'showEditForm');
    Route::get('/users/create', 'showCreateForm');
    Route::post('/register', 'register');
    Route::put('/{user}', 'update')->name('admin.update');
    Route::put('/users/{user}/block','blockUser');
    Route::put('/users/{user}/unblock','unblockUser');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('api/search/tags','searchTags');
    Route::get('api/search/tags/{search}','searchTags');

    Route::get('api/search/tag_proposals','searchTagProposals');
    Route::get('api/search/tag_proposals/{search}','searchTagProposals');

    Route::get('api/search/unblock_appeals','searchUnblockAppeals');
    Route::get('api/search/unblock_appeals/{search}','searchUnblockAppeals');

    Route::get('api/search/users', 'searchUser')->middleware('admin');
    Route::get('api/search/users/{search}', 'searchUser')->middleware('admin');


    Route::get('api/search/{search}', 'search');
});

Route::prefix('file')->middleware(['auth','blocked'])->controller(FileController::class)->group(function () {
    Route::post('/upload', 'uploadAjax');
    Route::delete('/delete', 'deleteAjax');
});

Route::prefix('bookmark')->middleware(['auth','blocked'])->controller(BookmarkController::class)->group(function () {
    Route::post('/', 'store')->name('bookmark.store');
    Route::delete('/{post}', 'destroy')->name('bookmark.destroy');
});

Route::prefix('bookmark')->middleware(['auth','blocked'])->controller(BookmarkController::class)->group(function () {
    Route::post('/', 'store')->name('bookmark.store');
    Route::delete('/{post}', 'destroy')->name('bookmark.destroy');
});

Route::middleware(['auth','blocked'])->controller(TagProposalController::class)->group(function () {
    Route::get('tag_proposal/create','showCreationForm');
    Route::post('tag_proposals/create','store');
    Route::get('/api/tag_proposals/all','showAll');

    Route::get('admin/tag_proposals','show')->middleware('admin')->name('admin.tag_proposals');
    Route::put('admin/tag_proposals/accept/{tag_proposal}','accept')->middleware('admin');
    Route::delete('admin/tag_proposals/delete/{tag_proposal}','destroy')->middleware('admin');
});

Route::controller(UnblockAppealController::class)->group(function () {
    Route::post('unblock_appeal/create','store')->name('unblock.create');

    Route::get('admin/unblock_appeals','show')->middleware('admin')->name('admin.unblock_appeals');
    Route::put('admin/unblock_appeals/accept/{unblock_appeal}','accept')->middleware('admin');
    Route::delete('admin/unblock_appeals/delete/{unblock_appeal}','destroy')->middleware('admin');
});

Route::middleware(['auth','blocked'])->controller(NotificationController::class)->group(function () {
    Route::get('/notifications', 'index')->name('notifications.index');
    Route::get('/api/notifications', 'getNotifications')->name('notifications.get');
});

Route::middleware(['auth','blocked'])->controller(NotificationSettingController::class)->group(function () {
    Route::put('/notification-settings', 'update');
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/call-back', 'callbackGoogle')->name('google-call-back');
});
