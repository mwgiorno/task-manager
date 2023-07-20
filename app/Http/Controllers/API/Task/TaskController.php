<?php

namespace App\Http\Controllers\API\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TaskController extends Controller
{
    public function index(TodoList $list, Request $request)
    {
        $this->authorize('view', $list);

        $filters = [
            'title' => $request->keyword,
            'tags' => $request->tags
        ];

        $list->load(['tasks' => function (Builder $query) use($filters) {
            $query->filter($filters);
        }]);

        return response()->json([
            'errors' => null,
            'result' => $list->tasks
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'list' => 'required|exists:todo_lists,id',
            'title' => 'required|string|max:255',
        ]);

        $task = Task::new($request->title, $request->list);

        return response()->json([
            'errors' => null,
            'result' => $task
        ]);
    }

    public function update(Task $task, Request $request)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string',
            'tags' => 'nullable|array'
        ]);

        $task->update([
            'title' => $request->title,
            'completed' => $request->boolean('completed')
        ]);

        $task->syncTags($request->tags);

        return response()->json([
            'errors' => null,
            'result' => $task
        ]);
    }
}
