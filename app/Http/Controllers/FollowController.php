<?php

namespace App\Http\Controllers;

use App\Enums\NotificationTypeEnum;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function followUser(User $user)
    {
        try {
            $this->authorize('follow', $user);
            Auth::user()->following()->attach($user->id);

            Notification::create([
                'notification_type' => NotificationTypeEnum::FOLLOW,
                'user_id' => $user->id,
                'follower_id' => Auth::id(),
            ]);

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
            'data' => $followers->items(),
            'next_page' => $followers->currentPage() + 1,
            'last_page' => $followers->lastPage(),
        ]);
    }
    public function followTag(Request $request, Tag $tag) 
    {
        $this->authorize('store', $tag); 
        try {
            Auth::user()->tags()->attach($request->tag);

            return response()->json(['message' => "Successfully followed {$request->tag}"]);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => "Cannot follow this {$request->tag}"], 403);
        }
    }

    public function unfollowTag(Request $request,Tag $tag) 
    {
        $this->authorize('delete', $tag); 
        try {
            Auth::user()->tags()->detach($request->tag);

            return response()->json(['message' => "Successfully unfollowed {$request->tag}"]);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => "Cannot unfollow this {$request->tag}"], 403);
        } 
    }
}
