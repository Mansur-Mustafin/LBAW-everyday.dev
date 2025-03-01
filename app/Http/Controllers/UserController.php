<?php

namespace App\Http\Controllers;

use App\Enums\ImageTypeEnum;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\NewsPost;
use App\Models\User;
use App\Models\Vote;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use PaginationTrait;

    public function userPosts(User $user)
    {
        $this->authorize('view', $user);

        return view('pages.user.user', [
            'title' => "{$user->public_name}'s Posts",
            'baseUrl' => route('api.user.posts', $user->id),
            'user' => $user
        ]);
    }

    public function getUserPosts(User $user, Request $request)
    {
        $this->authorize('view', $user);

        return $this->news_post_page($user->posts()->getQuery(), $request);
    }

    public function userUpvotes(User $user)
    {
        $this->authorize('view', $user);

        return view('pages.user.user', [
            'title' => "{$user->public_name}'s Upvoted Posts",
            'baseUrl' => route('api.user.upvotes', $user->id),
            'user' => $user
        ]);
    }

    public function getUserUpvotes(User $user, Request $request)
    {
        $this->authorize('view', $user);

        $upvotedPostIds = Vote::where('user_id', $user->id)
            ->where('is_upvote', true)
            ->where('vote_type', 'PostVote')
            ->pluck('news_post_id');

        $news_posts = NewsPost::whereIn('id', $upvotedPostIds)
            ->orderBy('created_at', 'desc');

        return $this->news_post_page($news_posts, $request);
    }

    public function showEditForm(User $user)
    {
        $this->authorize('update', $user);

        return view('pages.user.edit-user', ['user' => $user]);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

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

        if ($request->filled('new_password')) {
            if (!is_null($user->password)) { // created account via OAuth
                if (!Hash::check($validated['old_password'], $user->password)) {
                    return redirect()->back()->withErrors(['old_password' => 'The provided password does not match your current password.']);
                }
            }

            $user->password = Hash::make($request->input('new_password'));
            $user->save();
        }

        return redirect()->route('user.posts', ['user' => $user->id])
            ->withSuccess('You have successfully updated!');
    }

    public function destroy(User $user, Request $request)
    {
        $this->authorize('delete', $user);

        try {
            $user->delete();

            if ($user->id == Auth::id()) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
            return response()->json([
                'success' => true,
                'message' => "You have successfully deleted a user! {$user->username}",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the user. Please try again later.',
            ]);
        }
    }
}
