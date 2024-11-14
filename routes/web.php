<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;

Route::get('/', function () {
    return view('auth/login');
});
Route::middleware('auth')->group(function () {
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::get('/task/{task}/view', [TaskController::class, 'show'])->name('task.view');
    Route::put('/task/{task}/update', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{task}/destroy', [TaskController::class, 'destroy'])->name('task.destroy');
});


Route::get('/dashboard', [TaskController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
