<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine if the comment belongs to a news post.
     */
    public function belongsToPost(User $user, Comment $comment, NewsPost $newsPost): Response
    {
        return $newsPost->comments->contains($comment) ? Response::allow() : Response::deny('Comment does not belong to the post!');
    }
}
