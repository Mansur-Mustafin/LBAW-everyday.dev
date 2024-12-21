<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'post_id' => 'required|exists:news_post,id'
        ]);

        try {
            $user->bookmarkedPosts()->attach($validated['post_id']);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while bookmarking the post.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Post bookmarked successfully.'
        ]);
    }

    public function destroy(int $postId)
    {
        try {
            $user = Auth::user();

            $user->bookmarkedPosts()->detach($postId);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while removing the bookmark.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Bookmark removed successfully.'
        ]);
    }
}
