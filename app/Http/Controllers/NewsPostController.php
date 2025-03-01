<?php

namespace App\Http\Controllers;

use App\Enums\ImageTypeEnum;
use App\Http\Requests\NewsPost\StoreRequest;
use App\Http\Requests\NewsPost\UpdateRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\NewsPost;
use App\Models\Tag;
use App\Services\FileService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class NewsPostController extends Controller
{
    public function showCreationForm()
    {
        return view('pages.news.create-news', ['tags' => Tag::all()]);
    }

    public function showSingleThread(NewsPost $newsPost, comment $comment): View|Factory
    {
        if (!$newsPost->comments->contains($comment)) {
            abort(403);
        }

        $tags = $this->getAvailableTags($newsPost);
        $this->preparePostForUser($newsPost);
        $this->processComments([$comment], Auth::user());

        return view('pages.news.post', [
            'post' => $newsPost,
            'comments' => new Collection([$comment]),
            'thread' => 'single',
            'availableTags' => $tags,
        ]);
    }

    public function show(NewsPost $newsPost): View|Factory|RedirectResponse
    {
        $tags = $this->getAvailableTags($newsPost);
        $user = Auth::user();

        if ($user && $user->is_admin) {
            $comments = $newsPost->comments;
        } else {
            $comments = $newsPost->comments->where('is_omitted', '!=', 'true');
        }

        $this->preparePostForUser($newsPost);
        $this->processComments($comments, $user);

        if ($newsPost->is_omitted && !$user->is_admin) {
            return redirect('home');
        }

        return view('pages.news.post', [
            'post' => $newsPost,
            'tags' => $tags,
            'availableTags' => $tags,
            'thread' => 'multi',
            'comments' => $comments
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $content = strip_tags($validated['content'], '<span><p><strong><em><u><em><s><li><ol><ul><blockquote><pre><img><a>');
        $post = NewsPost::create([
            'title' => $validated['title'],
            'content' => $content,
            'for_followers' => $validated['for_followers'],
            'author_id' => Auth::user()->id,
        ]);

        if ($request->has('image')) {
            FileService::upload($request, $post, ImageTypeEnum::POST_TITLE->value);
        }

        if ($request->has('content_images')) {
            $paths = explode(',', $validated['content_images']);
            foreach ($paths as $path) {
                if (!empty($path)) {
                    Image::create([
                        'path' => $path,
                        'image_type' => ImageTypeEnum::POST_CONTENT,
                        'news_post_id' => $post->id,
                    ]);
                }
            }
        }

        $this->syncTags($post, $validated['tags'] ?? '');

        return redirect()->route('news.show', $post->id)
            ->withSuccess('You have successfully created post!');
    }

    public function update(UpdateRequest $request, NewsPost $newsPost): RedirectResponse
    {
        $this->authorize('update', $newsPost);

        $validated = $request->validated();

        $content = strip_tags($validated['content'], '<span><p><strong><em><u><em><s><li><ol><ul><blockquote><pre><img><br><a>');
        $newsPost->update([
            'title' => $validated['title'],
            'content' => $content,
            'for_followers' => $validated['for_followers'],
        ]);

        if ($request->hasFile('image') || $validated['remove_image'] == "true") {
            FileService::delete($newsPost, ImageTypeEnum::POST_TITLE->value);
        }
        if ($request->hasFile('image')) {
            FileService::upload($request, $newsPost, ImageTypeEnum::POST_TITLE->value);
        }

        $this->syncTags($newsPost, $validated['tags'] ?? '');

        if ($request->has('content_images')) {
            $paths = explode(',', $validated['content_images']);

            FileService::delete($newsPost, ImageTypeEnum::POST_CONTENT->value, $paths);

            foreach ($paths as $path) {
                if (!empty($path)) {
                    Image::insertOrIgnore([
                        'path' => $path,
                        'image_type' => ImageTypeEnum::POST_CONTENT,
                        'news_post_id' => $newsPost->id,
                    ]);
                }
            }
        }

        return redirect()->route('news.show', ['news_post' => $newsPost->id])
            ->withSuccess('Post updated successfully!');
    }

    public function destroy(NewsPost $newsPost): RedirectResponse
    {
        $this->authorize('delete', $newsPost);

        FileService::delete($newsPost, ImageTypeEnum::POST_TITLE->value);
        FileService::delete($newsPost, ImageTypeEnum::POST_CONTENT->value, []);

        $newsPost->delete();

        return redirect()->route('news.recent')
            ->withSuccess('Post deleted successfully!');
    }

    public function omit(Request $request, NewsPost $newsPost)
    {
        $this->authorize('omit', $newsPost);

        try {
            $newsPost->update([
                'is_omitted' => "true"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to omit the post.'
            ]);
        }

        return response()->json([
            'message' => 'Post omitted successfully!',
            'success' => true
        ]);
    }

    public function unomit(Request $request, NewsPost $newsPost)
    {
        $this->authorize('omit', $newsPost);

        try {
            $newsPost->update([
                'is_omitted' => 'false'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to unmit the post.',
                'success' => false
            ]);
        }

        return response()->json([
            'message' => 'Post un-omitted successfully!',
            'success' => true
        ]);
    }

    public function showOmittedPosts()
    {
        return view('pages.admin.admin', ['show' => 'omitted_posts']);
    }

    public function postAlreadyExists(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'post_id' => 'nullable|integer|exists:news_post,id',
        ]);

        $query = NewsPost::where('title', $request->input('title'));

        if ($request->filled('post_id')) {
            $query->where('id', '!=', $request->input('post_id'));
        }

        return response()->json([
            'exists' => $query->exists(),
            'success' => true,
        ]);
    }

    private function preparePostForUser(NewsPost $newsPost): void
    {
        $user = Auth::user();
        $userBookmarks = $user ? $user->bookmarkedPosts->pluck('id')->toArray() : [];
        $newsPost->is_bookmarked = false;

        if ($user) {
            $vote = $newsPost->votes()->where('user_id', $user->id)->first();

            if ($vote) {
                $newsPost->user_vote = $vote->is_upvote ? 'upvote' : 'downvote';
                $newsPost->user_vote_id = $vote->id;
            }

            $newsPost->is_bookmarked = in_array($newsPost->id, $userBookmarks);
        }
    }

    private function getAvailableTags(NewsPost $newsPost): Collection
    {
        $existingTags = $newsPost->tags->pluck('name')->toArray();
        return Tag::all()->reject(fn($tag) => in_array($tag->name, $existingTags));
    }

    private function syncTags(NewsPost $post, string $tags): void
    {
        if (empty($tags)) {
            return;
        }

        $tagNames = explode(',', $tags);
        $tagIds = Tag::whereIn('name', $tagNames)->pluck('id')->toArray();
        $post->tags()->sync($tagIds);
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
                if ($user->is_admin) {
                    $replies = $comment->replies;
                    self::processComments($comment->replies, $user);
                } else {
                    $replies = $comment->replies->where('is_omitted', '!=', 'true');
                    self::processComments($replies, $user);
                }
            }
        }
    }
}
