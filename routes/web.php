<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordRecoverController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSettingController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagProposalController;
use App\Http\Controllers\UnblockAppealController;
use App\Http\Controllers\StatisticsController;
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
Route::redirect('/', '/home')->name('home');
Route::redirect('/home', '/news/recent-feed');

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

Route::controller(MailController::class)->group(function () {
    Route::post('/emailrecover', 'send')->name('email.recover');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

Route::prefix('news')->middleware('blocked')->controller(FeedController::class)->group(function () {
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

Route::controller(NewsPostController::class)->group(function () {
    Route::middleware(['auth', 'blocked'])->group(function () {
        Route::get('news/create-post', 'showCreationForm')->name('news.create');
        Route::post('news/', 'store')->name('news');
        Route::put('news/{news_post}', 'update')->name('news.update');
        Route::delete('news/{news_post}', 'destroy');
    });
    Route::middleware('admin')->group(function () {
        Route::put('news/{news_post}/omit', 'omit')->name('news.omit');
        Route::put('news/{news_post}/unomit', 'unomit')->name('news.unomit');
        Route::get('admin/news/omitted_posts', 'showOmittedPosts')->name('admin.omitted_posts');
    });
    Route::get('news/{news_post}', 'show')->name('news.show');
    Route::get('news/{news_post}/comment/{comment}', 'showSingleThread');
});

Route::middleware(['auth', 'blocked'])->controller(CommentsController::class)->group(function () {
    Route::post('comments/', 'store');
    Route::put('comments/{comment}', 'update');
    Route::delete('comments/{comment}', 'destroy');
    Route::middleware('admin')->group(function () {
        Route::post('comments/{comment}/omit', 'omit');
        Route::post('comments/{comment}/unomit', 'unomit');
        Route::get('admin/news/omitted_comments', 'showOmittedComments')->name('admin.omitted_comments');
    });
});

Route::prefix('vote')->middleware(['auth', 'blocked'])->controller(VoteController::class)->group(function () {
    Route::post('/', 'store')->name('vote.store');
    Route::put('/{vote}', 'update')->name('vote.update');
    Route::delete('/{vote}', 'destroy')->name('vote.destroy');
});

Route::middleware(['auth', 'blocked'])->controller(UserController::class)->group(function () {
    Route::get('/users/{user}/posts', 'userPosts')->name('user.posts');
    Route::get('/api/users/{user}/posts', 'getUserPosts')->name('api.user.posts');

    Route::get('/users/{user}/upvotes', 'userUpvotes')->name('user.upvotes');
    Route::get('/api/users/{user}/upvotes', 'getUserUpvotes')->name('api.user.upvotes');

    Route::get('/users/{user}/edit', 'showEditForm')->name('user.edit');
    Route::put('/users/{user}', 'update')->name('user.update');
    Route::put('/users/{user}/anonymize', 'destroy');
});

Route::middleware(['auth', 'blocked'])->controller(FollowController::class)->group(function () {
    // User
    Route::post('/users/{user}/follow', 'followUser')->name('user.follow');
    Route::delete('/users/{user}/unfollow', 'unfollowUser')->name('user.unfollow');

    Route::get('users/{user}/followers', 'showFollowers')->name('user.followers');
    Route::get('users/{user}/following', 'showFollowing')->name('user.following');

    Route::get('api/users/{user}/followers', 'getFollowers');
    Route::get('api/users/{user}/following', 'getFollowing');

    // Tag
    Route::post('tag/store/{tag}', 'followTag')->name('user.follow_tag');
    Route::delete('tag/delete/{tag}', 'unfollowTag')->name('user.unfollow_tag');
});

Route::prefix('admin/tags')->middleware(['admin', 'blocked'])->controller(TagController::class)->group(function () {
    Route::get('/', 'show')->name('admin.tags');
    Route::get('/create', 'showCreationForm');
    Route::post('/create', 'store');
    Route::delete('/delete/{tag}', 'destroy');
});

Route::prefix('admin')->middleware('admin')->controller(AdminController::class)->group(function () {
    // Users
    Route::get('/', 'show')->name('admin.dashboard');    // TODO: criar realmente um dashboard, com estatistica?
    Route::get('/users', 'showUsers')->name('admin.users');
    Route::get('/users/{user}/edit', 'showEditForm');
    Route::get('/users/create', 'showCreateForm');
    Route::post('/register', 'register');
    Route::put('/{user}', 'update')->name('admin.update');
    Route::put('/users/{user}/block', 'blockUser');
    Route::put('/users/{user}/unblock', 'unblockUser');
});

// TODO:: add prefix
Route::prefix('/api/search')->controller(SearchController::class)->group(function () {
    Route::get('/tags/{search?}', 'searchTags');
    Route::middleware('admin')->group(function () {
        Route::get('/tag_proposals/{search?}', 'searchTagProposals');
        Route::get('/unblock_appeals/{search?}', 'searchUnblockAppeals');
        Route::get('/omitted_posts/{search?}', 'searchOmittedPosts');
        Route::get('/omitted_comments/{search?}', 'searchOmittedComments');
        Route::get('/users/{search?}', 'searchUser');
    });
    Route::get('/', 'search');
});

Route::prefix('file')->middleware(['auth', 'blocked'])->controller(FileController::class)->group(function () {
    Route::post('/upload', 'ajaxUpload');
});

Route::prefix('bookmark')->middleware(['auth', 'blocked'])->controller(BookmarkController::class)->group(function () {
    Route::post('/', 'store')->name('bookmark.store');
    Route::delete('/{post}', 'destroy')->name('bookmark.destroy');
});

Route::middleware(['auth', 'blocked'])->controller(TagProposalController::class)->group(function () {
    Route::get('tag_proposal/create', 'showCreationForm');
    Route::post('tag_proposals/create', 'store');

    Route::get('admin/tag_proposals', 'show')->middleware('admin')->name('admin.tag_proposals');
    Route::put('admin/tag_proposals/accept/{tag_proposal}', 'accept')->middleware('admin');
    Route::delete('admin/tag_proposals/delete/{tag_proposal}', 'destroy')->middleware('admin');
});

Route::controller(UnblockAppealController::class)->group(function () {
    Route::post('unblock_appeal/create', 'store')->name('unblock.create');

    Route::get('admin/unblock_appeals', 'show')->middleware('admin')->name('admin.unblock_appeals');
    Route::put('admin/unblock_appeals/accept/{unblock_appeal}', 'accept')->middleware('admin');
    Route::delete('admin/unblock_appeals/delete/{unblock_appeal}', 'destroy')->middleware('admin');
});

Route::middleware(['auth', 'blocked'])->controller(NotificationController::class)->group(function () {
    Route::get('/notifications', 'index')->name('notifications.index');
    Route::get('/api/notifications', 'getNotifications')->name('notifications.get');
});

Route::middleware(['auth', 'blocked'])->controller(NotificationSettingController::class)->group(function () {
    Route::put('/notification-settings', 'update');
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/call-back', 'callbackGoogle')->name('google-call-back');
});

Route::controller(StaticPageController::class)->group(function () {
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/main-features', 'features')->name('features');
});

Route::controller(ChartController::class)->group(function(){
    Route::get('chart/users', 'usersChart')->name('chart.users');
    Route::get('chart/posts', 'postsChart')->name('chart.posts');
    Route::get('chart/tags', 'tagsChart')->name('chart.tags');
});

Route::controller(StatisticsController::class)->group(function(){
    Route::get('api/stats','show')->middleware('admin');
});
