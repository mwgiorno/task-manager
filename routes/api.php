<?php

use App\Http\Controllers\API\Task\ImageController;
use App\Http\Controllers\API\Task\TaskController;
use App\Http\Controllers\API\TodoListController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/lists/{list}/tasks', [TaskController::class, 'index']);

    Route::post('/tasks', [TaskController::class, 'store']);
    Route::patch('/tasks/{task}', [TaskController::class, 'update']);
    Route::patch('/tasks/{task}/update-image', [ImageController::class, 'update']);
    Route::patch('/tasks/{task}/delete-image', [ImageController::class, 'destroy']);
    
    Route::get('/lists', [TodoListController::class, 'index']);
    Route::post('/lists', [TodoListController::class, 'store']);
});


