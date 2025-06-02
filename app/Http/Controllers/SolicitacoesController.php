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

        //$solicitante = DB::table('solicitantes')->orderBy('created_at', 'desc')->get('nome');

        $solicitante = Solicitante::orderBy('created_at', 'asc')->get();

        //$solicitacoes = DB::table('solicitacoes')->orderBy('created_at', 'desc')->get(['id', 'resultado', 'data_solicitacao']);

        $solicitacoes = Solicitacao::orderBy('created_at', 'asc')->get();

        return inertia::render('?', ['solicitante' => $solicitante, 'solicitacoes', $solicitacoes]);
    }

    public function mostrarSolicitacaoForm(){

        return inertia::render('?');
    }

    public function solicitacaoForm(Request $request){
        
        $request->validate([
            'texto' => 'required|string|max:320',

            'nome' => 'required|string|max:100',
            'descricao' => 'required|string|max:320',
            'valor' => 'required|numeric|min:0',
            'quantidade' => 'required|integer',
        ]);

        Solicitacao::create([
            'texto' => $request->texto//!!!!!!!!
        ]);
        
        Solicitacao::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
        ]);
    }

    public function umaSolicitacao($id){

        //$solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);

        $solicitacao = Solicitacao::findOrFail($id);

        //$assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);/////////ver se ta certo

        $assistente = Solicitacao::findOrFail($id)->user;

        return inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    public function updateSolicitacao(Request $request, $id){

        $request->validate([
            'data_solicitacao' => 'nullable|date',
            'data_deferido' => 'nullable|date',
            'resultado' => 'nullable|boolean',
            'texto' => 'nullable|string|max:320',
            'usuario_id' => 'nullable|integer|min:1',
            'auxilio_id' => 'nullable|integer|min:1',

            'nome' => 'nullable|string|max:100',
            'descricao' => 'nullable|string|max:100',
            'valor' => 'nullable|numeric|min:0',
            'quantidade' => 'nullable|integer',
        ]);

        $solicitacao = Solicitacao::findOrFail($id);

        $auxilio = Solicitacao::findOrFail($id)->auxilio;

        $userFK = User::find($request->usuario_id);
        $auxilioFK = Auxilio::find($request->auxilio_id);

        if (!$userFK and $request->usuario_id) {
            
            return redirect()->back()->with('erro', 'não existe esse usuario no sistema');
        }

        if (!$auxilioFK and $request->auxilio_id) {
            
            return redirect()->back()->with('erro', 'não existe o ID desse auxilio no sistema');
        }
        


        if(!$request->data_solicitacao == null){
            $solicitacao->data_solicitacao = $request->data_solicitacao;
        }
        if(!$request->data_deferido == null){
            $solicitacao->data_deferido = $request->data_deferido;
        }
        if(!$request->resultado == null){
            $solicitacao->resultado = $request->resultado;
        }
        if(!$request->texto == null){
            $solicitacao->texto = $request->texto;
        }
        if(!$request->usuario_id == null){
            $solicitacao->usuario_id = $request->usuario_id;
        }
        if(!$request->auxilio_id == null){
            $solicitacao->auxilio_id = $request->auxilio_id;
        }


        if(!$request->nome == null){
            $auxilio->nome = $request->nome;
        }
        if(!$request->descricao == null){
            $auxilio->descricao = $request->descricao;
        }
        if(!$request->valor == null){
            $auxilio->valor = $request->valor;
        }
        if(!$request->quantidade == null){
            $auxilio->quantidade = $request->quantidade;
        }

            $solicitacao->save();
            $auxilio->save();
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
