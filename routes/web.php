<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AnaliseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\SolicitacoesController;
use App\Http\Controllers\SolicitantesController;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {//////////////////rotas sem login
    return Inertia::render('welcome');
})->name('home');

Route::get('/agendamento', [AgendamentoController::class, 'mostrarAgenda'])->name('agendamento');

Route::post('/agendamento', [AgendamentoController::class, 'agendaForm'])->name('agendamentoForm');

Route::get('/teste/{id}', function ($id) {
    
    //$teste = Solicitacao::create(['texto' => 'pastel meio meh']);
    $user = User::findOrFail($id);

   return view('teste', ['user' => $user]);
});

Route::patch('/teste/{id}', function (Request $request, $id) {
    
        $user = Solicitacao::findOrFail($id);

        $request->validate([
            'email' => 'nullable|string|max:150',
            'name' => 'nullable|string|max:150',
            'usuario_id' => 'nullable|integer|max:150'
        ]);

        if(!$request->email == null){
            $user->email = $request->email;
        }

        if(!$request->name == null){
            $user->name = $request->name;
        }

        if(!$request->usuario_id == null){
            $user->usuario_id = $request->usuario_id;
        }

            $user->save();
        return $user->email;
   
})->name('test');

//////////////////

Route::middleware(['auth:web', /*'verified'*/])->group(function () { // ROTAS ASSISTENTE
    
    Route::get('/dashboard', function () {// ROTA TESTE
         return Inertia::render('dashboard');
    })->name('dashboard');



    Route::get('/dashboard/beneficiarios', [SolicitantesController::class, 'mostrarSolicitantes'])->name('beneficiarios');

    Route::get('/dashboard/beneficiarios/cadastrar-beneficiario', [SolicitantesController::class, 'mostrarSolicitantesForm'])->name('cadastrarBeneficiarioGet');

    Route::post('/dashboard/beneficiarios/cadastrar-beneficiario', [SolicitantesController::class, 'solicitantesForm'])->name('cadastrarBeneficiarioPost');

    //Route::get('/dashboard/beneficiarios/{id}', [assistenteController::class, 'umSolicitante'])->name('beneficiarioPage');//NAO SEI SE TEM NO pROJETO



    Route::get('/dashboard/solicitacoes', [SolicitacoesController::class, 'mostrarSolicitacao'])->name('solicitacoes');

    Route::get('/dashboard/solicitacoes/criar-solicitacao', [SolicitacoesController::class, 'mostrarSolicitacaoForm'])->name('criarSolicitacaoGet');

    Route::post('/dashboard/solicitacoes/criar-solicitacao', [SolicitacoesController::class, 'solicitacaoForm'])->name('criarSolicitacaoPost');

    Route::get('/dashboard/solicitacoes/{id}', [SolicitacoesController::class, 'umaSolicitacao'])->name('solicitacaoPage');

    //Route::get('/dashboard/teste', [SolicitantesController::class, 'mostrarSolicitantes'])->name('teste');//TESTE////////////////

});

Route::middleware(['auth:admin'])->group(function () {  // ROTAS DE ADM
    /*Route::get('/admin-dashboard', function () {
    return Inertia::render('AdminDashboard');
    })->name('admindashboard');*/

    Route::get('/admin-dashboard/solicitacoes-pendentes', [AnaliseController::class, 'motrarSolicitacoesADM'])->name('solicitacoesPendentes');

    Route::get('/admin-dashboard/solicitacoes-pendentes/{id}', [AnaliseController::class, 'mostrarAnalise'])->name('umaAnalise');

    Route::patch('/admin-dashboard/solicitacoes-pendentes/{id}', [AnaliseController::class, 'analiseForm'])->name('umaAnaliseForm');



    Route::get('/admin-dashboard/entregas', [EntregasController::class, 'mostrarEntregas'])->name('entregas');

    Route::get('/admin-dashboard/entregas/{id}', [EntregasController::class, 'umaEntrega'])->name('umaEntrega');

    Route::patch('/admin-dashboard/entregas/{id}', [EntregasController::class, 'umaEntregaAutorizar'])->name('autorizarEntrega');

    Route::get('/admin-dashboard/entregas/{id}/organizar-entrega', [EntregasController::class, 'mostrarCadastroEntrega'])->name('organizarEntrega');

    Route::post('/admin-dashboard/entregas/{id}/organizar-entrega', [EntregasController::class, 'cadastroEntrega'])->name('organizarEntregaForm');



    Route::get('/admin-dashboard/usuarios', [EntregasController::class, 'mostrarUsers'])->name('usuarios');

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