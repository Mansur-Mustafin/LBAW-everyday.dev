<?php

namespace App\Policies;

use App\Models\NewsPost;
use App\Models\User;

class NewsPostPolicy
{
    /**
     * Determine whether the user can view the post.
     */
    public function view(?User $user, NewsPost $newsPost): bool
    {
        if ($user == null) {
            if ($newsPost->for_followers) {
                return false;
            }
            return true;
        }

        if ($user->is_admin) {
            return true;
        }

        // I can see my post.
        if ($newsPost->author->id == $user->id) {
            return true;
        }

        if ($newsPost->for_followers && !$newsPost->author->followers()->where('follower_id', $user->id)->exists()) {
            // Post is for followers only, and user is not a follower
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NewsPost $newsPost): bool
    {
        return $user->id === $newsPost->author_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NewsPost $newsPost): bool
    {
        if ($newsPost->upvotes != 0) {
            return false;
        }

        if ($newsPost->downvotes != 0) {
            return false;
        }

        if ($newsPost->comments()->exists()) {
            return false;
        }

        return $user->id === $newsPost->author_id;
    }

    /**
     * Determine whether the user can omit the model.
     */
    public function omit(User $user, NewsPost $newsPost): bool
    {
        return $user->is_admin;
    }
}
