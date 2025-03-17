<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Task routes.
Route::resource('tasks', TaskController::class)->middleware(['auth', 'verified']);
// Handle task status.
Route::post('/tasks/{task}/handle-status/', [TaskController::class, 'handleStatus'])->name('handle.task.status');
// Attach a tag to the task route.
Route::get('/tasks/{task}/{tag}/add', [TaskController::class, 'addTag'])->name('task.add.tag');
// Remove a tag from the task route.
Route::get('/tasks/{task}/{tag}/remove', [TaskController::class, 'removeTag'])->name('task.remove.tag');
// Tag routes.
Route::middleware(['auth', 'verified'])
    ->prefix('tags')
    ->name('tags.')
    ->controller(TagController::class)
    ->group(function() {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{tag}', 'edit')->name('edit');
        Route::post('edit/{tag}', 'update')->name('update');
        Route::delete('delete/{tag}', 'destroy')->name('destroy');
    });

require __DIR__.'/auth.php';
