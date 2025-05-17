<?php

use App\Http\Controllers\assistenteController;
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
    Route::get('/dashboard', function () {// ROTA TESTE
         return Inertia::render('dashboard');
    })->name('dashboard');


    Route::get('/dashboard/beneficiarios', [assistenteController::class, 'mostrarSolicitantes'])->name('beneficiarios');


    Route::get('/dashboard/beneficiarios/cadastrar-beneficiario', [assistenteController::class, 'mostrarSolicitantesForm'])->name('cadastrarBeneficiarioGet');

    Route::post('/dashboard/beneficiarios/cadastrar-beneficiario', [assistenteController::class, 'solicitantesForm'])->name('cadastrarBeneficiarioPost');


    Route::get('/dashboard/solicitacoes', [assistenteController::class, 'mostrarSolicitacao'])->name('solicitacoes');


    Route::get('/dashboard/solicitacoes/criar-solicitacao', [assistenteController::class, 'mostrarSolicitacaoForm'])->name('criarSolicitacaoGet');

    Route::post('/dashboard/solicitacoes/criar-solicitacao', [assistenteController::class, 'solicitacaoForm'])->name('criarSolicitacaoPost');


    Route::get('/dashboard/beneficiarios/{id}', [assistenteController::class, 'umSolicitante'])->name('beneficiarioPage');

    Route::get('/dashboard/solicitacoes/{id}', [assistenteController::class, 'umaSolicitacao'])->name('solicitacaoPage');

    //Route::get('/dashboard/teste', [assistenteController::class, 'mostrarSolicitantes'])->name('teste');//TESTE////////////////

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