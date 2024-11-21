<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use App\Http\Controllers\NewsPostPaginationTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use NewsPostPaginationTrait;

    public function showUserPosts(User $user, Request $request)
    {
        $news_posts = NewsPost::where('author_id', $user->id)
            ->orderBy('created_at', 'desc');

        $title = "{$user->public_name}'s Posts";
        $baseUrl = "/users/{$user->id}/posts";

        return $this->news_post_page($news_posts, $title, $request, $baseUrl, ['user' => $user], 'pages.user');
    }

    public function showUserUpvotes(User $user, Request $request)
    {
        $upvotedPostIds = Vote::where('user_id', $user->id)
                          ->where('is_upvote', true)
                          ->where('vote_type', 'PostVote')
                          ->pluck('news_post_id');
        $news_posts = NewsPost::whereIn('id', $upvotedPostIds)
                    ->orderBy('created_at', 'desc');

        $title = "{$user->public_name}'s Upvoted Posts";
        $baseUrl = "/users/{$user->id}/upvotes";

        return $this->news_post_page($news_posts, $title, $request, $baseUrl, ['user' => $user], 'pages.user');
    }

    public function showEditForm(User $user, Request $request)
    {
        if (!Auth::check() && Auth::user()->id != $user->id) {
            return redirect('/');
        }

        return view('pages.edit-user', ['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'public_name' => 'required|string|max:250',
            'username' => 'required|string|max:40',
            'email' => [
                'required',
                'email',
                'max:250',
                Rule::unique('user')->ignore($user->id),
            ],
            'image' => 'nullable|image|max:2048',
        ]);

        $user->public_name = $request->input('public_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        if ($request->has('image')) {
            Image::query()
                ->where('user_id', '=', $user->id)
                ->where('image_type', '=', Image::TYPE_PROFILE)
                ->delete();

            FileController::upload($request, $user, Image::TYPE_PROFILE);
        }

        return redirect()->route('user.posts', ['user' => $user->id])
            ->withSuccess('You have successfully updated!');
    }
}
