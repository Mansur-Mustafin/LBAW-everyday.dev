<?php

namespace App\Policies;

use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NewsPostPolicy
{
    /**
     * Determine whether the user can view the post.
     */
    public function view(User $user, NewsPost $newsPost): bool
    {
        if ($user->is_admin) return true;

        if($newsPost->for_followers && !$newsPost->author->followers()->where('follower_id', $user->id)->exists()){
            // O post for followers only, and user is not a follower
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
        if($newsPost->upvotes != 0) return false;

        if($newsPost->downvotes != 0) return false;

        // TODO: Add here check for comments

        return $user->id === $newsPost->author_id;
    }
}
