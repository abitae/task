<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\TaskLive;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/task');
Route::redirect('/dashboard', '/task');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/task', TaskLive::class)->name('task.index');
});

require __DIR__.'/auth.php';
