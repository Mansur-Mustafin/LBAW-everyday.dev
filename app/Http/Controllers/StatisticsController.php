<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\NewsPost;
use App\Models\Tag;
use App\Models\TagProposal;
use App\Models\UnblockAppeal;
use App\Models\Comment;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    //
    public function show()
    {
        $users_count = User::where('status','!=','deleted')->count();
        $news_count = NewsPost::count();
        $tags_count = Tag::count();
        $tags_proposal_count = TagProposal::count();
        $unblock_appeal_count = UnblockAppeal::count();

        $omitted_posts_count = NewsPost::where('is_omitted','true')->count();
        $omitted_comments_count = Comment::where('is_omitted','true')->count();

        return response()->json([
            "users"=>$users_count,
            "news"=>$news_count,
            "tags"=>$tags_count,
            "tag_proposals"=>$tags_proposal_count,
            "unblock_appeals"=>$unblock_appeal_count,
            "omitted_posts"=>$omitted_posts_count,
            "omitted_comments"=>$omitted_comments_count,
        ]);
    }
}
