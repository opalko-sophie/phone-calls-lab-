<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CallController as AdminCallController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index']);

Route::get('/dashboard', [MainController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('admin/calls', AdminCallController::class)
        ->only(['index', 'create', 'store', 'show', 'destroy'])
        ->names('admin.calls');
});

require __DIR__.'/auth.php';
