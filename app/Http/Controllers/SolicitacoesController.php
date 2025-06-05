<?php

namespace App\Http\Controllers;

use App\Models\Auxilio;
use App\Models\Entrega;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SolicitacoesController extends Controller
{
    public function mostrarSolicitacao(){

        //$solicitante = Solicitante::orderBy('created_at', 'asc')->get();

        //$solicitacoes = Solicitacao::orderBy('created_at', 'asc')->get();

        $solicitante = Solicitante::has('solicitacoes')->with('solicitacoes')->get();

        $solicitacoes = $solicitante->pluck('solicitacoes')->flatten();

        

        return view('mostrarSolicitacao', ['solicitante' => $solicitante, 'solicitacoes' => $solicitacoes]);
    }

    public function mostrarSolicitacaoForm($id){

        $solicitante = Solicitante::findOrFail($id);
        return view('mostrarSolicitacaoForm', ['solicitante' => $solicitante]);
    }

    public function solicitacaoForm(Request $request, $id){

        $solicitante = Solicitante::findOrFail($id);

        
        $user = User::find(1);
        
        $request->validate([
            'texto' => 'required|string|max:320',

            'nome' => 'required|string|max:100',
            'descricao' => 'required|string|max:320',
            'valor' => 'required|decimal:2|min:0',
            'quantidade' => 'required|integer',
        ]);

        $solicitacao = new Solicitacao([
            'texto' => $request->texto
        ]);
        
        $auxilio = new Auxilio([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
        ]);

        $solicitacao->user()->associate($user);
        $solicitacao->solicitante()->associate($solicitante);
        $solicitacao->save();  
        $solicitacao->auxilio()->save($auxilio);

        return [
    'auxilio' => $auxilio,
    'solicitacao' => $solicitacao,
];
        
    }

    public function umaSolicitacao($id){

        $solicitacao = Solicitacao::findOrFail($id);

        $assistente = $solicitacao->user;

        $solicitante = $solicitacao->solicitante;

        return view('umaSolicitacao', ['solicitacao' => $solicitacao, 'assistente' => $assistente, 'solicitante' => $solicitante]);
    }

    public function updateSolicitacao(Request $request, $id){

        $request->validate([
            'data_solicitacao' => 'nullable|date',
            'data_deferido' => 'nullable|date',
            'resultado' => 'nullable|boolean',
            'texto' => 'nullable|string|max:320',
            'usuario_id' => 'nullable|integer|min:1',
            
            'solicitacao_id' => 'nullable|integer|min:1',  
            'nome' => 'nullable|string|max:100',
            'descricao' => 'nullable|string|max:100',
            'valor' => 'nullable|decimal:2|min:0',
            'quantidade' => 'nullable|integer',
        ]);

        $solicitacao = Solicitacao::findOrFail($id);

        $auxilio = Solicitacao::findOrFail($id)->auxilio;

        return $auxilio;

        $userFK = User::find($request->usuario_id);
        $auxilioFK = Auxilio::find($request->auxilio_id);

        if (!$userFK and $request->usuario_id) {//garante que o user existe
            
            return redirect()->back()->with('erro', 'não existe esse usuario no sistema');
        }

        if (!$auxilioFK and $request->auxilio_id) {//garante que o auxilio existe
            
            return redirect()->back()->with('erro', 'não existe o ID desse auxilio no sistema');
        }
        


        if($request->data_solicitacao){
            $solicitacao->data_solicitacao = $request->data_solicitacao;
        }
        if($request->data_deferido){
            $solicitacao->data_deferido = $request->data_deferido;
        }
        if($request->resultado){
            $solicitacao->resultado = $request->resultado;
        }
        if($request->texto){
            $solicitacao->texto = $request->texto;
        }
        if($request->usuario_id){
            $solicitacao->usuario_id = $request->usuario_id;
        }
        

        if($request->solicitacao_id){
            $auxilio->solicitacao_id = $request->solicitacao_id;
        }
        if($request->nome){
            $auxilio->nome = $request->nome;
        }
        if($request->descricao){
            $auxilio->descricao = $request->descricao;
        }
        if($request->valor){
            $auxilio->valor = $request->valor;
        }
        if($request->quantidade){
            $auxilio->quantidade = $request->quantidade;
        }

            $solicitacao->save();
            $auxilio->save();
            return $solicitacao + $auxilio;
    }

    public function deleteSolicitacao(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            $solicitacao = Solicitacao::findOrFail($id);
            $solicitacao->auxilio()->delete();
            $solicitacao->delete();
        }
        return redirect()->back();
    }
}
