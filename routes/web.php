<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AnaliseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\SolicitacoesController;
use App\Http\Controllers\SolicitantesController;
use App\Models\Auxilio;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


Route::get('/', function () {//////////////////rotas sem login
    return Inertia::render('?');
})->name('home');


Route::get('/agendamento', [AgendamentoController::class, 'mostrarAgendaForm'])
    ->name('agendamento');

Route::post('/agendamento', [AgendamentoController::class, 'agendaForm'])
    ->name('agendamentoForm');

Route::get('/teste/{id}', function ($id) {
    
    //$teste = Solicitacao::create(['texto' => 'pastel meio meh']);
    $user = User::findOrFail($id);

   return $user;
});

Route::get('/teste', function (Request $request) {
    
        /*$user = Solicitacao::findOrFail($id);

        $request->validate([
            'email' => 'nullable|string|max:150',
            'name' => 'nullable|string|max:150',
            'usuario_id' => 'nullable|integer|size:4'
        ]);

        $ser2 = User::find($request->usuario_id);
        if ($request->usuario_id) {
            return 'p7orraraa';
        }

        if($request->email){
            $user->email = $request->email;
        }

        if(!$request->name == null){
            $user->name = $request->name;
        } 
        $user->save();
        return $ser2->email;
        

        $Solicitante = Solicitante::create([
            
            'nis' => '55555555555',
            'cpf' => '55555555555',
            'nome' => 'sim',
            'sexo' => 'm',
            'endereco' => 'eita',
            'cep' => '11111111',
        ]);
        
       $Solicitacao = new Solicitacao([
            'texto' => 'textoTeste2'//!!!!!!!!
        ]);*/
        $id = Auth::user()->id;
        $user = User::find($id);

        $Solicitante = new Solicitante([
            
            'nis' => '55555555555',
            'cpf' => '55555555555',
            'nome' => 'simmm',
            'sexo' => 'm',
            'endereco' => 'eita',
            'cep' => '11111111',
        ]);

        $user->Solicitantes()->save($Solicitante);

})->name('test')->middleware('auth:web');

//////////////////

Route::middleware(['auth:web', /*'verified'*/])->group(function () { // ROTAS ASSISTENTE
    
    Route::get('/dashboard', function () {///// ROTA TESTE
         return Inertia::render('dashboard');
    })->name('dashboard');


    //Solicitantes
    Route::get('/dashboard/beneficiarios', [SolicitantesController::class, 'mostrarSolicitantes'])
        ->name('beneficiarios');

    Route::get('/dashboard/beneficiarios/cadastrar-beneficiario', [SolicitantesController::class, 'mostrarSolicitantesForm'])
        ->name('cadastrarBeneficiarioGet');

    Route::post('/dashboard/beneficiarios/cadastrar-beneficiario', [SolicitantesController::class, 'solicitantesForm'])
        ->name('cadastrarBeneficiarioPost');

    Route::get('/dashboard/beneficiarios/{id}', [SolicitantesController::class, 'umSolicitante'])
        ->name('beneficiarioPage');//NAO SEI SE TEM NO pROJETO

    Route::patch('/dashboard/beneficiarios/{id}', [SolicitantesController::class, 'updateSolicitante'])
        ->name('beneficiarioPage');

    Route::delete('/dashboard/beneficiarios/{id}', [SolicitantesController::class, 'deleteSolicitantes'])
        ->name('beneficiarioPage');


    //Agendamentos
    Route::get('/dashboard/agendamentos', [AgendamentoController::class, 'mostrarAgendamentos'])
        ->name('cadastrarBeneficiarioGet');

    Route::get('/dashboard/agendamentos/{id}', [AgendamentoController::class, 'umAgendamento'])
        ->name('cadastrarBeneficiarioGet');

    Route::patch('/dashboard/agendamentos/{id}', [AgendamentoController::class, 'updateAgendamento'])
        ->name('cadastrarBeneficiarioGet');

    Route::delete('/dashboard/agendamentos/{id}', [AgendamentoController::class, 'deleteAgendamento'])
        ->name('cadastrarBeneficiarioGet');


    //Solicitacao
    Route::get('/dashboard/solicitacoes', [SolicitacoesController::class, 'mostrarSolicitacao'])
        ->name('solicitacoes');

    Route::get('/dashboard/solicitacoes/criar-solicitacao', [SolicitacoesController::class, 'mostrarSolicitacaoForm'])
        ->name('criarSolicitacaoGet');

    Route::post('/dashboard/solicitacoes/criar-solicitacao', [SolicitacoesController::class, 'solicitacaoForm'])
        ->name('criarSolicitacaoPost');

    Route::get('/dashboard/solicitacoes/{id}', [SolicitacoesController::class, 'umaSolicitacao'])
        ->name('solicitacaoPage');

    Route::patch('/dashboard/solicitacoes/{id}', [SolicitacoesController::class, 'updateSolicitacao'])
        ->name('solicitacaoPage');

    Route::delete('/dashboard/solicitacoes/{id}', [SolicitacoesController::class, 'deleteSolicitacao'])
        ->name('solicitacaoPage');

    //Route::get('/dashboard/teste', [SolicitantesController::class, 'mostrarSolicitantes'])->name('teste');//TESTE////////////////

});

Route::middleware(['auth:admin'])->group(function () {  // ROTAS DE ADM

    //Solicitacoes
    Route::get('/admin-dashboard/solicitacoes-pendentes', [AnaliseController::class, 'motrarSolicitacoesADM'])
        ->name('solicitacoesPendentes');

    Route::get('/admin-dashboard/solicitacoes-pendentes/{id}', [AnaliseController::class, 'mostrarAnalise'])
        ->name('umaAnalise');

    Route::patch('/admin-dashboard/solicitacoes-pendentes/{id}', [AnaliseController::class, 'analiseForm'])
        ->name('umaAnaliseForm');


    //Entregas
    Route::get('/admin-dashboard/entregas', [EntregasController::class, 'mostrarEntregas'])
        ->name('entregas');

    Route::get('/admin-dashboard/entregas/{id}', [EntregasController::class, 'umaEntrega'])
        ->name('umaEntrega');

    Route::patch('/admin-dashboard/entregas/{id}', [EntregasController::class, 'umaEntregaAutorizar'])
        ->name('autorizarEntrega');

    Route::patch('/admin-dashboard/entregas/{id}', [EntregasController::class, 'updateEntrega'])
        ->name('updateEntrega');

    Route::delete('/admin-dashboard/entregas/{id}', [EntregasController::class, 'deleteEntrega'])
        ->name('deleteEntrega');

    Route::get('/admin-dashboard/entregas/{id}/organizar-entrega', [EntregasController::class, 'mostrarCadastroEntrega'])
        ->name('organizarEntrega');

    Route::post('/admin-dashboard/entregas/{id}/organizar-entrega', [EntregasController::class, 'cadastroEntrega'])
        ->name('organizarEntregaForm');


    //Usuarios
    Route::get('/admin-dashboard/usuarios', [EntregasController::class, 'mostrarUsers'])
        ->name('usuarios');

    Route::patch('/admin-dashboard/usuarios', [EntregasController::class, 'updateUsers'])
        ->name('updateUsuarios');

    Route::delete('/admin-dashboard/usuarios', [EntregasController::class, 'deleteUsers'])
        ->name('deleteUsuarios');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// teste dos guards
/* dd([
    'guard_admin' => Auth::guard('admin')->check(),
    'guard_web' => Auth::guard('web')->check(),
    'default_user' => Auth::user(),
    'admin_user' => Auth::guard('admin')->user(),
]); */