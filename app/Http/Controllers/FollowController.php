<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\ImageTypeEnum;
use App\Models\NewsPost;
use App\Models\User;
use App\Models\Vote;
use App\Services\FileService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class FollowController extends Controller
{
    public function followUser(User $user)
    {
        try {
            $this->authorize('follow', $user);
            Auth::user()->following()->attach($user->id);

            return response()->json(['message' => 'Successfully followed user']);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'Cannot follow this user'], 403);
        }
    }

    public function unfollowUser(User $user)
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
