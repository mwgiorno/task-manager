<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index(Request $request)
    {
        $lists = $request->user()->lists;

        return response()->json([
            'errors' => null,
            'result' => $lists
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $list = TodoList::new(
            $request->title,
            $request->description,
            $request->user()->id
        );

        return response()->json([
            'errors' => null,
            'result' => $list
        ]);
    }
}
