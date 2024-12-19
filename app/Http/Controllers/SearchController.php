<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\Tag;
use App\Models\TagProposal;
use App\Models\UnblockAppeal;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use PaginationTrait;

    public static function getPosts(string $searchQuery): Builder
    {
        return NewsPost::query()
            ->join('user', 'user.id', '=', "news_post.id")
            ->whereRaw('(tsvectors @@ plainto_tsquery(\'english\',?) OR title=?)', [$searchQuery, $searchQuery])
            ->orderByRaw('ts_rank(tsvectors,plainto_tsquery(\'english\',?)) DESC', [$searchQuery]);
    }

    public static function getPostsByTag(Tag $tag): Builder
    {
        return NewsPost::query()
            ->where('is_omitted', '!=', 'true')
            ->join('news_post_tag', 'news_post_id', '=', 'news_post.id')
            ->where('tag_id', $tag->id);
    }

    public function search(Request $request)    // TODO: return type?
    {
        $searchQuery = $request->input('query', '');

        $newsPosts = self::getPosts($searchQuery)->where('is_omitted', '!=', 'true')->limit(3)->get();

        $query = empty($searchQuery) ? '' : "%" . strtolower($searchQuery) . "%";

        $tags = Tag::query()
            ->whereRaw("LOWER(name) like ?", [$query])
            ->limit(3)
            ->get();

        $users = User::query()
            ->whereRaw("LOWER(username) LIKE ? OR LOWER(public_name) LIKE ? AND status <> 'deleted'", [$query, $query])
            ->limit(3)
            ->get()
            ->unique('id');

        return response()->json([
            "news_posts" => $newsPosts,
            "tags" => $tags,
            "users" => $users,
        ]);
    }

    public function searchTags(Request $request)
    {
        $tagQuery = "%" . strtolower($request->search) . "%";

        $tags = Tag::query()
            ->whereRaw("LOWER(name) like ?", $tagQuery);

        return $this->paginate($tags, $request, 12);
    }

    public function searchUser(Request $request)
    {
        $searchQuery = "%" . strtolower($request->search) . "%";

        $users = User::query()
            ->whereRaw("LOWER(username) like ? OR LOWER(public_name) like ? AND status <> 'deleted'", [$searchQuery, $searchQuery]);

        return $this->paginate($users, $request, 10);
    }

    public function searchTagProposals(Request $request)
    {
        $searchQuery = "%" . strtolower($request->search) . "%";

        $tag_proposals = TagProposal::query()
            ->with('proposer')
            ->whereRaw("LOWER(name) like ? AND is_resolved <> true", [$searchQuery]);

        return $this->paginate($tag_proposals, $request, 10);
    }

    public function searchUnblockAppeals(Request $request)
    {
        $searchQuery = "%" . strtolower($request->search) . "%";

        $unblock_appeals = UnblockAppeal::select('user.*', 'unblock_appeal.*')
            ->leftJoin('user', 'user.id', '=', 'unblock_appeal.user_id')
            ->where('status', 'pending')
            ->where('is_resolved', 'false')
            ->whereRaw("LOWER(username) like ?", [$searchQuery]);

        return $this->paginate($unblock_appeals, $request, 10);
    }

    public function searchOmittedPosts(Request $request)
    {
        if ($request->search == '') {
            $omitted_posts = NewsPost::where('is_omitted', 'true');
            return $this->paginate($omitted_posts, $request, 10);
        } else {
            $searchQuery = "%" . strtolower($request->search) . "%";
            $omitted_posts = self::getPosts($searchQuery)->where('is_omitted', 'true');
            return $this->paginate($omitted_posts, $request, 10);
        }
    }

    public function searchOmittedComments(Request $request)
    {
        $searchQuery = "%" . strtolower($request->search) . "%";
        $omitted_comments = Comment::select('user.*', 'comment.*')
            ->leftJoin('user', 'user.id', '=', 'comment.author_id')
            ->where('is_omitted', 'true')
            ->whereRaw("LOWER(username) like ?", [$searchQuery]);
        return $this->paginate($omitted_comments, $request, 10);
    }
}
