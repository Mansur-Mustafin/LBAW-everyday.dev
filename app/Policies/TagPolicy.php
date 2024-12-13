<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag;

class TagPolicy
{
  public function follow(User $user, Tag $tag): bool
  {
    return !$user->tags->contains($tag);
  }

  public function unfollow(User $user, Tag $tag): bool
  {
    return $user->tags->contains($tag);
  }
}
