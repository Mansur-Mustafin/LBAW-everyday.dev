<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $postId = $request->post_id;

        $user->bookmarkedPosts()->attach($postId);

        return response()->json(['message' => 'Bookmarked']);
    }

    public function destroy($postId)
    {
        $user = Auth::user();

        $user->bookmarkedPosts()->detach($postId);

        return response()->json(['message' => 'Bookmark removed']);
    }
}
