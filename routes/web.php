<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/admin-dashboard', function () {
    return Inertia::render('admin-dashboard');
})->middleware('auth:admin');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
