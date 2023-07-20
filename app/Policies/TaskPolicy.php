<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Task $task)
    {
        return $user->id === $task->list->user;
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->list->user;
    }
}
