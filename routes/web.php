<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AnaliseController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\SolicitacoesController;
use App\Http\Controllers\SolicitantesController;
use App\Http\Controllers\UsersController;
use App\Models\Auxilio;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* Route::get('/teste/{id}', function ($id) {
    $user = User::findOrFail($id);
   return $user;
}); */

/*Route::get('/teste', function (Request $request) {
    
        $user = Solicitacao::findOrFail($id);

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
        ]);
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

})->name('test')->middleware('auth:web');*/


Route::get('/', function () {//////////////////rotas sem login
    return view('menuInicial');
})->name('home');

Route::get('/agendamento', [AgendamentoController::class, 'mostrarAgendaForm'])
    ->name('agendamento');

Route::post('/agendamento', [AgendamentoController::class, 'agendaForm'])
    ->name('agendamentoForm');

    

Route::middleware('guest')->group(function () { // ROTAS ASSISTENTE
    
    Route::get('/dashboard', function () {///// ROTA TESTE
         return view('menuAssistente');
    })->name('dashboardAssistente');/**/


    //Solicitantes
    Route::get('/dashboard/beneficiarios', [SolicitantesController::class, 'mostrarSolicitantes'])
        ->name('mostrarSolicitantes');

    Route::get('/dashboard/beneficiarios/cadastrar-beneficiario', [SolicitantesController::class, 'mostrarSolicitantesForm'])
        ->name('mostrarSolicitantesForm');

    Route::post('/dashboard/beneficiarios/cadastrar-beneficiario', [SolicitantesController::class, 'solicitantesForm'])
        ->name('solicitantesForm');

    Route::get('/dashboard/beneficiarios/{id}', [SolicitantesController::class, 'umSolicitante'])
        ->name('umSolicitante');//NAO SEI SE TEM NO PROJETO

    Route::patch('/dashboard/beneficiarios/{id}', [SolicitantesController::class, 'updateSolicitante'])
        ->name('updateSolicitante');

    Route::delete('/dashboard/beneficiarios/{id}', [SolicitantesController::class, 'deleteSolicitantes'])
        ->name('deleteSolicitantes');


    //Agendamentos
    Route::get('/dashboard/agendamentos', [AgendamentoController::class, 'mostrarAgendamentos'])
        ->name('mostrarAgendamentos');

    Route::get('/dashboard/agendamentos/{id}', [AgendamentoController::class, 'umAgendamento'])
        ->name('umAgendamento');

    Route::patch('/dashboard/agendamentos/{id}', [AgendamentoController::class, 'updateAgendamento'])
        ->name('updateAgendamento');

    Route::delete('/dashboard/agendamentos/{id}', [AgendamentoController::class, 'deleteAgendamento'])
        ->name('deleteAgendamento');



    /***ERRO, SEM ID***
    Route::get('/dashboard/solicitacoes/criar-solicitacao', [SolicitacoesController::class, 'mostrarSolicitacaoForm'])
        ->name('criarSolicitacaoGet');      
     Route::post('/dashboard/solicitacoes/criar-solicitacao', [SolicitacoesController::class, 'solicitacaoForm'])
        ->name('criarSolicitacaoPost'); */

    //Solicitacao
    Route::get('/dashboard/solicitacoes', [SolicitacoesController::class, 'mostrarSolicitacao'])
        ->name('mostrarSolicitacao');

    Route::get('/dashboard/beneficiarios/{id}/criar-solicitacao', [SolicitacoesController::class, 'mostrarSolicitacaoForm'])
        ->name('mostrarSolicitacaoForm');

    Route::post('/dashboard/beneficiarios/{id}/criar-solicitacao', [SolicitacoesController::class, 'solicitacaoForm'])
        ->name('solicitacaoForm');

    Route::get('/dashboard/solicitacoes/{id}', [SolicitacoesController::class, 'umaSolicitacao'])
        ->name('umaSolicitacao');

    Route::patch('/dashboard/solicitacoes/{id}', [SolicitacoesController::class, 'updateSolicitacao'])
        ->name('updateSolicitacao');

    Route::delete('/dashboard/solicitacoes/{id}', [SolicitacoesController::class, 'deleteSolicitacao'])
        ->name('deleteSolicitacao');

});

Route::middleware('guest')->group(function () {  // ROTAS DE ADM

Route::get('/admin-dashboard', function () {///// ROTA TESTE
         return view('menuAdm');
    })->name('dashboardAdm');

    //Solicitacoes
    Route::get('/admin-dashboard/solicitacoes-pendentes', [AnaliseController::class, 'motrarSolicitacoesADM'])
        ->name('motrarSolicitacoesADM');

    Route::get('/admin-dashboard/solicitacoes-pendentes/{id}', [AnaliseController::class, 'mostrarAnalise'])
        ->name('mostrarAnalise');

    Route::patch('/admin-dashboard/solicitacoes-pendentes/{id}', [AnaliseController::class, 'analiseForm'])
        ->name('analiseForm');


    //Entregas
    Route::get('/admin-dashboard/entregas', [EntregasController::class, 'mostrarEntregas'])
        ->name('mostrarEntregas');

    Route::get('/admin-dashboard/entregas/{id}', [EntregasController::class, 'umaEntrega'])
        ->name('umaEntrega');

    Route::patch('/admin-dashboard/entregas/{id}', [EntregasController::class, 'umaEntregaAutorizar'])
        ->name('umaEntregaAutorizar');

    Route::post('/admin-dashboard/entregas/{id}', [EntregasController::class, 'updateEntrega'])
        ->name('updateEntrega');

    Route::delete('/admin-dashboard/entregas/{id}', [EntregasController::class, 'deleteEntrega'])
        ->name('deleteEntrega');

    Route::get('/admin-dashboard/entregas/{id}/organizar-entrega', [EntregasController::class, 'mostrarCadastroEntrega'])
        ->name('mostrarCadastroEntrega');

    Route::post('/admin-dashboard/entregas/{id}/organizar-entrega', [EntregasController::class, 'cadastroEntrega'])
        ->name('cadastroEntrega');


    //Usuarios
    Route::get('/admin-dashboard/usuarios', [UsersController::class, 'mostrarUsers'])
        ->name('mostrarUsers');

    Route::get('/admin-dashboard/usuarios/{id}', [UsersController::class, 'umUser'])
        ->name('umUser');

    Route::patch('/admin-dashboard/usuarios/{id}', [UsersController::class, 'updateUsers'])
        ->name('updateUsers');

    Route::delete('/admin-dashboard/usuarios/{id}', [UsersController::class, 'deleteUsers'])
        ->name('deleteUsers');

    

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