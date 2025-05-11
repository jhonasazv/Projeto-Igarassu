<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('dashboard', function () {
         return Inertia::render('dashboard');
         /* dd([
    'guard_admin' => Auth::guard('admin')->check(),
    'guard_web' => Auth::guard('web')->check(),
    'default_user' => Auth::user(),
    'admin_user' => Auth::guard('admin')->user(),
]); */
    })->name('dashboard');
});

Route::get('/admin-dashboard', function () {
    return Inertia::render('AdminDashboard');
     /* dd([
    'guard_admin' => Auth::guard('admin')->check(),
    'guard_web' => Auth::guard('web')->check(),
    'default_user' => Auth::user(),
    'admin_user' => Auth::guard('admin')->user(),
]); */
})->middleware('auth:admin')->name('admindashboard');

//Route::get('/admin-dashboard', fn () => '<h1>Hello</h1>')->middleware('auth:admin')->name('admindashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
