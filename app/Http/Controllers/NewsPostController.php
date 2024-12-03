<?php

namespace App\Http\Controllers;

use App\Enums\ImageTypeEnum;
use App\Models\Comment;
use App\Models\NewsPost;
use App\Models\Tag;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NewsPostController extends Controller
{
    public function showCreationForm()
    {
        $tags = Tag::all();
        return view('pages.create-news', ['tags' => $tags]);
    }

    public function showSingleThread(NewsPost $newsPost, comment $comment)
    {
        if (Gate::denies('belongsToPost', [$comment, $newsPost])) {
            return redirect()->route('news.show', $newsPost->id)
                ->withErrors('Comment does not belong to the correspondent news.');
        }

        $tags = $this->getAvailableTags($newsPost);
        $this->processComments([$comment], Auth::user());

        return view('pages.post', [
            'post' => $newsPost,
            'comments' => new Collection([$comment]),
            'thread' => 'single',
            'availableTags' => $tags,
        ]);
    }

    public function show(NewsPost $newsPost)
    {
        $tags = $this->getAvailableTags($newsPost);
        $user = Auth::user();

        if ($user) {
            $vote = $newsPost->votes()->where('user_id', $user->id)->first();

            if ($vote) {
                $newsPost->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                $newsPost->user_vote_id = $vote->id;
            }
        }

        $this->processComments($newsPost->comments, $user);

        return view('pages.post', [
            'post' => $newsPost,
            'tags' => $tags,
            'availableTags' => $tags,
            'thread' => 'multi',
            'comments' => $newsPost->comments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'for_followers' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string'
        ]);

        $post = NewsPost::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'for_followers' => $validated['for_followers'],
            'author_id' => Auth::user()->id,
        ]);

        if ($request->has('image')) {
            FileService::upload($request, $post, ImageTypeEnum::POST_TITLE->value);
        }

        $this->syncTags($post, $validated['tags'] ?? '');

        return redirect()->route('home')
            ->withSuccess('You have successfully created post!');
    }

    public function update(Request $request, newsPost $newsPost)
    {
        $this->authorize('update', $newsPost);

        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'for_followers' => 'nullable|string',
            'tags' => 'nullable|string',
            'remove_image' => 'required|string',
        ]);

        $newsPost->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'for_followers' => $validated['for_followers'],
        ]);

        if ($request->hasFile('image') || $validated['remove_image'] == "true") {
            FileService::delete($newsPost, ImageTypeEnum::POST_TITLE->value);
        }
        if ($request->hasFile('image')) {
            FileService::upload($request, $newsPost, ImageTypeEnum::POST_TITLE->value);
        }

        $this->syncTags($newsPost, $validated['tags'] ?? '');

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

    private function getAvailableTags(NewsPost $newsPost)
    {
        $existingTags = $newsPost->tags->pluck('name')->toArray();
        return Tag::all()->reject(fn($tag) => in_array($tag->name, $existingTags));
    }

    private function syncTags(NewsPost $post, string $tags)
    {
        if (empty($tags)) {
            return;
        }

        $tagNames = explode(',', $tags);
        $tagIds = Tag::whereIn('name', $tagNames)->pluck('id')->toArray();
        $post->tags()->attach($tagIds);
    }

    static function processComments($comments, $user)
    {
        if (!$user) {
            return;
        }

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
}
