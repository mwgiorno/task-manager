<?php

namespace App\Policies;

use App\Models\TodoList;
use App\Models\User;

class TodoListPolicy
{
    public function view(User $user, TodoList $list)
    {
        return $user->id === $list->user;
    }
}
