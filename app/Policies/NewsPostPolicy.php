<?php

namespace App\Policies;

use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NewsPostPolicy
{
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
        return $user->id === $newsPost->author_id;
    }
}
