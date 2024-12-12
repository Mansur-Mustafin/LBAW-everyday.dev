<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\Tag;
use App\Models\TagProposal;
use App\Models\UnblockAppeal;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use PaginationTrait;

    public static function getPosts($search_query)
    {
        return NewsPost::join('user', 'user.id', '=', "news_post.id")
            ->whereRaw('(tsvectors @@ plainto_tsquery(\'english\',?) OR title=?)', [$search_query, $search_query])
            ->orderByRaw('ts_rank(tsvectors,plainto_tsquery(\'english\',?)) DESC', [$search_query]);
    }

    public static function getPostsByTag(Tag $tag)
    {
        return NewsPost::join('news_post_tag', 'news_post_id', '=', 'news_post.id')
            ->where('tag_id', $tag->id);
    }

    public function search(Request $request)
    {
        $search_query = $request->search;
        $news_posts = $this->getPosts($search_query)->take(3)->get();

        $query = $search_query == '' ? '' : "%{$search_query}%";

        $tags = Tag::whereRaw("LOWER(name) like ?", [strtolower($query)])->take(3)->get();
        $users_from_username = User::whereRaw("LOWER(username) like ?", [strtolower($query)])->take(3)->get();
        $users_from_public_name = User::whereRaw("LOWER(public_name) like ?", [strtolower($query)])->take(3)->get();

        $users = $users_from_username->merge($users_from_public_name)->unique('id');

        return response()->json([
            "news_posts" => $news_posts,
            "tags" => $tags,
            "users" => $users,
        ], 200);
    }

    public function searchTags(Request $request)
    {
        $tag_query = "%" . strtolower($request->search) . "%";
        $tags = Tag::whereRaw("LOWER(name) like ?", $tag_query);
        return $this->paginate_tags($tags, $request);
    }

    public function searchUser(Request $request)
    {
        $search_query = "%" . strtolower($request->search) . "%";

        $users = User::whereRaw("LOWER(username) like ? OR LOWER(public_name) like ?", [$search_query, $search_query]);
        return $this->paginate_users($users, $request);
    }


    public function searchTagProposals(Request $request)
    {
        $search_query = "%" . strtolower($request->search) . "%";

        $tag_proposals = TagProposal::with('proposer')->whereRaw("LOWER(name) like ?", [$search_query]);
        return $this->paginate_tag_proposals($tag_proposals, $request);
    }

    public function searchUnblockAppeals(Request $request)
    {
        $search_query = "%" . strtolower($request->search) . "%";

        $unblock_appeals = UnblockAppeal::select('user.*', 'unblock_appeal.*')
            ->leftJoin('user', 'user.id', '=', 'unblock_appeal.user_id')
            ->where('status', 'pending')
            ->where('is_resolved', 'false')
            ->whereRaw("LOWER(username) like ?", [$search_query]);
        return $this->paginate_unblock_appeals($unblock_appeals, $request);
    }
}
