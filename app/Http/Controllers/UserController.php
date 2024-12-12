<?php

namespace App\Http\Controllers;

use App\Enums\ImageTypeEnum;
use App\Models\NewsPost;
use App\Models\User;
use App\Models\Vote;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use PaginationTrait;

    public function userPosts(User $user, Request $request)
    {
        $title = "{$user->public_name}'s Posts";

        return view('pages.user', ['title' => $title, 'baseUrl' => route('api.user.posts', $user->id), 'user' => $user]);
    }

    public function getUserPosts(User $user, Request $request)
    {
        $news_posts = NewsPost::where('author_id', $user->id)
            ->orderBy('created_at', 'desc');


        return $this->news_post_page($news_posts, $request);
    }

    public function userUpvotes(User $user, Request $request)
    {
        $title = "{$user->public_name}'s Upvoted Posts";

        return view('pages.user', ['title' => $title, 'baseUrl' => route('api.user.upvotes', $user->id), 'user' => $user]);
    }

    public function getUserUpvotes(User $user, Request $request)
    {
        $upvotedPostIds = Vote::where('user_id', $user->id)
            ->where('is_upvote', true)
            ->where('vote_type', 'PostVote')
            ->pluck('news_post_id');

        $news_posts = NewsPost::whereIn('id', $upvotedPostIds)
            ->orderBy('created_at', 'desc');

        return $this->news_post_page($news_posts, $request);
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
}
