<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag;

class TagPolicy
{
  public function store(User $user, Tag $tag): bool
  {
    return !$user->tags->contains($tag);
  }

  public function delete(User $user, Tag $tag): bool
  {
    return $user->tags->contains($tag);
  }
}
