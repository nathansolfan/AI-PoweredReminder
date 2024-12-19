<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TASK Route
Route::get('/tasks/filter', [TaskController::class, 'filter'])->name('tasks.filter');

Route::resource('tasks', TaskController::class);
Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');
Route::get('/overview', [TaskController::class, 'overview'])->name('overview');
Route::get('/tasks{task}/delete-attachment', [TaskController::class, 'deleteAttachment'])->name('tasks.deleteAttachment');

require __DIR__.'/auth.php';

