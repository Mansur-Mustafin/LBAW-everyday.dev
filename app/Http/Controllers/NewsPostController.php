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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class NewsPostController extends Controller
{
    public function showCreationForm()
    {
        return view('pages.create-news', ['tags' => Tag::all()]);
    }

    public function showSingleThread(NewsPost $newsPost, comment $comment): View|Factory
    {
        $this->authorize('belongsToPost', [$comment, $newsPost]);

        $tags = $this->getAvailableTags($newsPost);
        $this->preparePostForUser($newsPost);
        $this->processComments([$comment], Auth::user());

        return view('pages.post', [
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

        if($user->is_admin) {
            $comments = $newsPost->comments;
        } else {
            $comments = $newsPost->comments->where('is_omitted','!=','true');
        }

        //dd($comments);
       
        $this->preparePostForUser($newsPost);
        $this->processComments($comments, $user);

        if($newsPost->is_omitted && !$user->is_admin) {
            return redirect('home');
        }

        return view('pages.post', [
            'post' => $newsPost,
            'tags' => $tags,
            'availableTags' => $tags,
            'thread' => 'multi',
            'comments' => $comments
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validate();

        $post = NewsPost::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'for_followers' => $validated['for_followers'],
            'author_id' => Auth::user()->id,
        ]);

        if ($request->has('image')) {
            FileService::upload($request, $post, ImageTypeEnum::POST_TITLE->value);
        }

        if ($request->has('content_images')) {
            $paths = explode(',', $validated['content_images']);
            foreach ($paths as $path) {
                Image::create([
                    'path' => $path,
                    'image_type' => ImageTypeEnum::POST_CONTENT,
                    'news_post_id' => $post->id,
                ]);
            }
        }

        $this->syncTags($post, $validated['tags'] ?? '');

        return redirect()->route('news.show', $post->id)
            ->withSuccess('You have successfully created post!');
    }

    public function update(UpdateRequest $request, NewsPost $newsPost): RedirectResponse
    {
        $this->authorize('update', $newsPost);

        $validated = $request->validate();

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
            ->with('message', 'Post atualizado com sucesso!');
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

    public function omit(NewsPost $newsPost)
    {
        $newsPost->update([
            'is_omitted'=>"true"
        ]);

        return redirect()->route('news.show',['news_post'=>$newsPost->id])
            ->with('message','Post omitted successfully!');
    }

    public function unomit(NewsPost $newsPost)
    {
        $newsPost->update([
            'is_omitted'=>'false'
        ]);

        return redirect()->route('news.show',['news_post'=>$newsPost->id])
            ->with('message','Post un-omitted successfully!');
    }

    public function showOmittedPosts() {
        return view('pages.admin.admin', ['show' => 'omitted_posts']);
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
        // TODO: nos temos que processar todos os comments? nao podemos so processar quais vamos mostrar?

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
                if($user->is_admin) {
                    $replies = $comment->replies;
                    self::processComments($comment->replies, $user);
                } else {
                    $replies = $comment->replies->where('is_omitted','!=','true');
/*                     dd($replies->map(function ($element) {
                        return $element->content;
                    })); */
                    self::processComments($replies,$user);
                }
            }
        }
    }
}
