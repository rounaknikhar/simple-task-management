<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TagPolicy
{
    /**
     * Determine whether the user can edit models.
     */
    public function edit(User $user, Tag $tag): Response
    {
        return $this->canAccess($user, $tag);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tag $tag): Response
    {
        return $this->canAccess($user, $tag);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tag $tag): Response
    {
        return $this->canAccess($user, $tag);
    }

    /**
     * Determine whether the user can access the Tag.
     */
    private function canAccess(User $user, Tag $tag): Response
    {
        return $user->id === $tag->user_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
