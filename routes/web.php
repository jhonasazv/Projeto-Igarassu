<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\semLogincontroller;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {//////////////////rotas sem login
    return Inertia::render('welcome');
})->name('home');

Route::get('/agendamento', [semLogincontroller::class, 'mostrarAgenda'])->name('agendamento');

Route::post('/agendamento', [semLogincontroller::class, 'agendaForm'])->name('agendamentoForm');
//////////////////

Route::middleware(['auth:web', 'verified'])->group(function () { // ROTAS ASSISTENTE
    Route::get('dashboard', function () {
         return Inertia::render('dashboard');
         
    })->name('dashboard');
});

Route::middleware(['auth:admin', 'verified'])->group(function () {  // ROTAS DE ADM
    Route::get('/admin-dashboard', function () {

    return Inertia::render('AdminDashboard');

    })->name('admindashboard');
});

//Route::get('/admin-dashboard', fn () => '<h1>Hello</h1>')->middleware('auth:admin')->name('admindashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// teste dos guards
/* dd([
    'guard_admin' => Auth::guard('admin')->check(),
    'guard_web' => Auth::guard('web')->check(),
    'default_user' => Auth::user(),
    'admin_user' => Auth::guard('admin')->user(),
]); */