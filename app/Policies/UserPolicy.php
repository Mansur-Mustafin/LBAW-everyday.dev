<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $user): bool
    {
        return $authUser->id === $user->id || $authUser->is_admin;
    }

    /**
     * Determine whether the user can follow another user.
     */
    public function follow(User $currentUser, User $userToFollow)
    {
        return $currentUser->id !== $userToFollow->id
            && !$currentUser->following()->where('followed_id', $userToFollow->id)->exists();
    }

    /**
     * Determine whether the user can unfollow another user.
     */
    public function unfollow(User $currentUser, User $userToUnfollow)
    {
        return $currentUser->following()->where('followed_id', $userToUnfollow->id)->exists();
    }
}
