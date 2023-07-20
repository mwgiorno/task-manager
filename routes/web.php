<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Task\ImageController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/', [TodoListController::class, 'index'])->name('lists');
    Route::get('/lists/{list}', [TodoListController::class, 'show'])->name('lists.show');
});

require __DIR__.'/auth.php';
