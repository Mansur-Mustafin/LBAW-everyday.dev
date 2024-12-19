<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NewsPost;
use App\Models\Tag;
use App\Models\TagProposal;
use App\Models\UnblockAppeal;
use App\Models\Comment;

class StatisticsController extends Controller
{
    public function show()
    {
        $counts = [
            "users" => User::where('status', '!=', 'deleted')->count(),
            "news" => NewsPost::count(),
            "tags" => Tag::count(),
            "tag_proposals" => TagProposal::count(),
            "unblock_appeals" => UnblockAppeal::count(),
            "omitted_posts" => NewsPost::where('is_omitted', 'true')->count(),
            "omitted_comments" => Comment::where('is_omitted', 'true')->count(),
        ];
        
        return response()->json($counts);
    }
}
