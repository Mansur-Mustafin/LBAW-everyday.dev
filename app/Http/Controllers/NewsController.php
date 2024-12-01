<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\NewsPost;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    use PaginationTrait;

    public function recent_feed(Request $request)
    {
        $news_posts = NewsPost::orderBy('created_at', 'desc');
        $title = "Recent News";
        $baseUrl = '/news/recent-feed';
        return NewsController::news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function top_feed(Request $request)
    {
        $news_posts = NewsPost::orderBy(DB::raw('upvotes - downvotes'), 'desc');
        $title = "Top News";
        $baseUrl = '/news/top-feed';
        return NewsController::news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function my_feed(Request $request)
    {
        $user = Auth::user();
        $title = "Your News";
        $following = $user->following()->pluck('id');
        $news_posts = NewsPost::whereIn('author_id', $following)
            ->orderBy('created_at', 'desc');
        $baseUrl = '/news/my-feed';
        return NewsController::news_post_page($news_posts, $title, $request, $baseUrl);
    }

    public function showCreationForm()
    {
        $tags = Tag::all();

        return view('pages.create-news', ['tags' => $tags]);
    }

    public function showSingleThread(newsPost $newsPost, comment $comment)
    {
        if (Gate::inspect('belongsToPost', [$comment, $newsPost])->allowed()) {

            $tags = Tag::all();
            $existingTags = $newsPost->tags->pluck('name')->toArray();
            $stillAvailableTags = $tags->filter(function ($tag) use ($existingTags) {
                return !in_array($tag->name, $existingTags);
            });

            $this->processComments([$comment], Auth::user());

            $comment = new Collection([$comment]);

            return view('pages.post', ['post' => $newsPost, 'comments' => $comment, 'thread' => 'single', 'availableTags' => $stillAvailableTags]);
        }

        return redirect()->to('news/' . $newsPost->id)->withErrors('Comment does not belong to the correspondent news');
    }

    static function processComments($comments, $user)
    {
        if (!$user)
            return;

        foreach ($comments as $comment) {
            $comment->user_vote = null;

            $vote = $comment->votes()->where('user_id', $user->id)->first();

            if ($vote) {
                $comment->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                $comment->user_vote_id = $vote->id;
            }

            if ($comment->replies) {
                self::processComments($comment->replies, $user);
            }
        }
    }

    public function show(newsPost $news_post)
    {
        $tags = Tag::all();
        $existingTags = $news_post->tags->pluck('name')->toArray();
        $stillAvailableTags = $tags->filter(function ($tag) use ($existingTags) {
            return !in_array($tag->name, $existingTags);
        });

        $user = Auth::user();
        $news_post->user_vote = null;
        if ($user) {
            $vote = $news_post->votes()->where('user_id', $user->id)->first();

            if ($vote) {
                $news_post->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                $news_post->user_vote_id = $vote->id;
            }
        }

        $this->processComments($news_post->comments, $user);

        return view('pages.post', [
            'post' => $news_post,
            'tags' => $tags,
            'availableTags' => $stillAvailableTags,
            'thread' => 'multi',
            'comments' => $news_post->comments
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'for_followers' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string'
        ]);

        $post = NewsPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'for_followers' => $request->for_followers,
            'author_id' => Auth::user()->id,
        ]);
        if ($request->has('image')) {
            FileController::upload($request, $post, Image::TYPE_POST_TITLE);
        }

        if ($request->tags != null) {
            $tags = explode(',', $request->tags);
            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();
            $post->tags()->attach($tagIds);
        }


        return redirect()->route('home')
            ->withSuccess('You have successfully created post!');
    }

    public function update(Request $request, newsPost $newsPost)
    {
        $this->authorize('update', $newsPost);

        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'for_followers' => 'nullable|string',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'remove_image' => 'required|string',
        ]);

        $newsPost->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'for_followers' => $request->input('for_followers', false),
        ]);

        if ($request->has('image') || $request->input('remove_image') == "true") {
            Image::query()
                ->where('news_post_id', '=', $newsPost->id)
                ->where('image_type', '=', Image::TYPE_POST_TITLE)
                ->delete();
        }
        if ($request->has('image')) {
            FileController::upload($request, $newsPost, Image::TYPE_POST_TITLE);
        }

        if ($request->tags != null) {
            $tags = explode(',', $request->tags);
            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();
            $newsPost->tags()->sync($tagIds);
        }

        return redirect()->route('news.show', ['news_post' => $newsPost->id])
            ->with('message', 'Post atualizado com sucesso!');
    }

    public function destroy(newsPost $newsPost)
    {
        $this->authorize('delete', $newsPost);

        $newsPost->delete();

        return redirect()->route('home')
            ->withSuccess('Post deleted successfully!');
    }
}
