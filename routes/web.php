<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::redirect('/', '/todos');
Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
Route::resource('todos', TodoController::class)->except('show');
