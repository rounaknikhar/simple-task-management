<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can edit models.
     */
    public function show(User $user, Task $task): Response
    {
        return $this->canAccess($user, $task);
    }

    /**
     * Determine whether the user can edit models.
     */
    public function edit(User $user, Task $task): Response
    {
        return $this->canAccess($user, $task);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): Response
    {
        return $this->canAccess($user, $task);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): Response
    {
        return $this->canAccess($user, $task);
    }

    /**
     * Determine whether the user can access the task.
     */
    private function canAccess(User $user, Task $task): Response
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
