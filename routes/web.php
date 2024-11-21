<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');






Route::post('tasks/complete/{task}', [TaskController::class, 'complete'])->name('tasks.complete');


Route::get('tasks/active', [TaskController::class, 'active'])->name('tasks.active');
Route::get('tasks/completed', [TaskController::class, 'completed'])->name('tasks.completed');


Route::resource('tasks', TaskController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
