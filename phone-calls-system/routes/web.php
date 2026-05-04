<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CallController as AdminCallController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.calls.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('admin/calls', AdminCallController::class)
        ->only(['index', 'create', 'store', 'show', 'destroy'])
        ->names('admin.calls');
});

require __DIR__.'/auth.php';