<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use App\Http\Controllers\PaginationTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    use PaginationTrait;

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

    public function showAdmin(Request $request)
    {
        $users = User::take(10)->get(); // TODO: para o que isso?
        return view('pages.admin.admin', ['users' => $users]);
    }

    public function showEditForm(User $user, Request $request)
    {
        $this->authorize('update', $user);

        return view('pages.edit-user', ['user' => $user]);
    }

    public function showEditFormAdmin(User $user, Request $request)
    {
        return view('pages.admin.edit-user', ['user' => $user]);
    }

    public function showCreateFormAdmin(Request $request)
    {
        return view('pages.admin.create-user');
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $request->validate([
            'public_name' => 'required|string|max:250',
            'username' => [
                'required',
                'string',
                'max:40',
                Rule::unique('user')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:250',
                Rule::unique('user')->ignore($user->id),
            ],
            'reputation' => 'nullable',
            'is_admin' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:4|confirmed',
            'remove_image' => 'required|string',
        ]);

        if ($request->user()->isAdmin()) {
            if ($request->filled('reputation')) {
                $user->reputation = $request->input('reputation');
            }
            if ($request->filled('is_admin')) {
                $user->is_admin = $request->input('is_admin');
            }
        }
        $user->public_name = $request->input('public_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        if ($request->has('image') || $request->input('remove_image') == "true") {
            Image::query()
                ->where('user_id', '=', $user->id)
                ->where('image_type', '=', Image::TYPE_PROFILE)
                ->delete();
        }
        if ($request->has('image')) {
            FileController::upload($request, $user, Image::TYPE_PROFILE);
        }

        if ($request->filled('new_password') && ($request->filled('old_password') || $request->user()->isAdmin())) {
            if (!Hash::check($request->input('old_password'), $user->password) && !$request->user()->isAdmin()) {
                return redirect()->back()->withErrors(['old_password' => 'The provided password does not match your current password.']);
            }

            $user->password = Hash::make($request->input('new_password'));
            $user->save();
        }

        return redirect()->route('user.posts', ['user' => $user->id])
            ->withSuccess('You have successfully updated!');
    }

    public function follow(User $user)
    {
        try {
            $this->authorize('follow', $user);

            Auth::user()->following()->attach($user->id);

            return response()->json(['message' => 'Successfully followed user']);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'Cannot follow this user'], 403);
        }
    }

    public function unfollow(User $user)
    {
        try {
            $this->authorize('unfollow', $user);

            Auth::user()->following()->detach($user->id);

            return response()->json(['message' => 'Successfully unfollowed user']);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'Cannot follow this user'], 403);
        }
    }

    public function showFollowers(User $user)
    {
        return view('pages.users', ['title' => "Followers", 'user' => $user]);
    }

    public function showFollowing(User $user)
    {
        return view('pages.users', ['title' => "Following", 'user' => $user]);
    }

    public function getFollowers(User $user, Request $request)
    {
        $following = $user->followers()->paginate(10);

        $following->getCollection()->transform(function ($followedUser) {
            $followedUser->can_follow = auth()->user()->can('follow', $followedUser);
            $followedUser->can_unfollow = auth()->user()->can('unfollow', $followedUser);
            return $followedUser;
        });

        return response()->json([
            'users'     => $following,
            'next-page' => $following->currentPage() + 1,
            'last_page' => $following->lastPage()
        ]);
    }

    public function getFollowing(User $user, Request $request)
    {
        $following = $user->following()->paginate(10);

        $following->getCollection()->transform(function ($followedUser) {
            $followedUser->can_follow = auth()->user()->can('follow', $followedUser);
            $followedUser->can_unfollow = auth()->user()->can('unfollow', $followedUser);
            return $followedUser;
        });

        return response()->json([
            'users'     => $following,
            'next-page' => $following->currentPage() + 1,
            'last_page' => $following->lastPage()
        ]);
    }
}
