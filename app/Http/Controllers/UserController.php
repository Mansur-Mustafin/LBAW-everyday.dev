<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\User;
use App\Models\Vote;
use App\Enums\ImageTypeEnum;
use App\Services\FileService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    public function showEditForm(User $user, Request $request)
    {
        $this->authorize('update', $user);

        return view('pages.edit-user', ['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $validated = $request->validate([
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
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:4|confirmed',
            'remove_image' => 'required|string',
        ]);

        $user->update([
            'public_name' => $validated['public_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ]);

        if ($request->hasFile('image') || $validated['remove_image'] == "true") {
            FileService::delete($user, ImageTypeEnum::PROFILE->value);
        }
        if ($request->hasFile('image')) {
            FileService::upload($request, $user, ImageTypeEnum::PROFILE->value);
        }

        if ($request->filled('new_password') && $request->filled('old_password')) {
            if (!Hash::check($request->input('old_password'), $user->password)) {
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
        return $this->getFollowData($user->followers(), $request);
    }

    public function getFollowing(User $user, Request $request)
    {
        return $this->getFollowData($user->following(), $request);
    }

    private function getFollowData($query, Request $request)
    {
        $followers = $query->paginate(10);

        $followers->getCollection()->transform(function ($follower) {
            $follower->can_follow = auth()->user()->can('follow', $follower);
            $follower->can_unfollow = auth()->user()->can('unfollow', $follower);
            return $follower;
        });

        return response()->json([
            'users' => $followers,
            'next_page' => $followers->currentPage() + 1,
            'last_page' => $followers->lastPage(),
        ]);
    }
}
