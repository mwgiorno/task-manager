<?php

namespace App\Http\Controllers;

use App\Helpers\Tagify;
use App\Http\Requests\TodoList\CreateRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index(Request $request)
    {
        return view('lists.index');
    }

    public function show(TodoList $list, Request $request)
    {
        $this->authorize('view', $list);
        
        return view('lists.show', compact('list'));
    }
}
