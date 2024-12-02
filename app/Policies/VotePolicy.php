<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vote;

class VotePolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vote $vote): bool
    {
        return $user->id === $vote->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vote $vote): bool
    {
        return $user->id === $vote->user_id;
    }
}
