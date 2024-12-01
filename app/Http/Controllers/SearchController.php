<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use PaginationTrait;

    public function getPosts($search_query)
    {
        return NewsPost::join('user', 'user.id', '=', "news_post.id")
            ->whereRaw('(tsvectors @@ plainto_tsquery(\'english\',?) OR title=?)', [$search_query, $search_query])
            ->orderByRaw('ts_rank(tsvectors,plainto_tsquery(\'english\',?)) DESC', [$search_query]);
    }

    public function getPostsByTag(Tag $tag)
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

    public function searchPost(Request $request)
    {
        $search_query = $request->search;
        $news_posts = SearchController::getPosts($search_query);
        $title = "Related Posts";
        $baseUrl = "/search/posts/{$search_query}";

        return $this->news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function searchTag(Request $request)
    {
        $tag_query = $request->search;
        $tag = Tag::where('name', $tag_query)->first();
        $news_posts = $this->getPostsByTag($tag);
        $title = "{$tag_query} Posts";
        $baseUrl = "/search/tags/{$tag_query}";

        return $this->news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function searchUser(Request $request)
    {
        $search_query = "%" . strtolower($request->search) . "%";

        $users = User::whereRaw("LOWER(username) like ? OR LOWER(public_name) like ?", [$search_query, $search_query]);
        return $this->paginate_users($users, $request);
    }
}