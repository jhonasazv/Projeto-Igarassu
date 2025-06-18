<?php

namespace App\Http\Controllers;

use App\Models\auxilio;
use App\Models\Entrega;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class EntregasController extends Controller
{
    public function mostrarEntregas(){

        $solicitantes = Solicitante::whereHas('solicitacoes', function ($query) {
        $query->where('resultado', 1);
        })->with(['solicitacoes' => function ($query) {
        $query->where('resultado', 1);
        }])->get();

        $solicitacoes = $solicitantes->pluck('solicitacoes')->flatten();

        inertia::render('?', ['solicitacoes' => $solicitacoes, 'solicitantes' => $solicitantes]);
    }

    public function umaEntrega($id){

        $solicitacao = Solicitacao::with(['user', 'solicitante'])->findOrFail($id);

        $assistente = $solicitacao->user;
        $solicitante = $solicitacao->solicitante;

        $entrega = $solicitacao->entrega;

        inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente, 'solicitante' => $solicitante,
        'entrega' => $entrega]);
    }

    public function umaEntregaAutorizar(Request $request, $id){//NAO SEI SE ESTA PEGANDO

        $botao = $request->input('action');

        $entrega = Solicitacao::findOrFail($id)->entrega;

        if(!$entrega){

            return redirect()->back()->with('erro', 'A entrega ainda não foi cadastrada');
        }

        if($entrega->situacao == 1){

            return redirect()->back()->with('erro', 'A entrega já foi autorizada');
        }

        if($botao == 'autorizar'){

            $entrega->situacao = 1;
            $entrega->save();

            return redirect()->back()->with('sucesso', 'indeferimento confirmado');
        }
    }

    public function mostrarCadastroEntrega($id){
         $solicitacao = Solicitacao::findOrFail($id);

        inertia::render('?', ['solicitacao' => $solicitacao]);
    }

    public function cadastroEntrega(Request $request, $id){//TESTAR

        $solicitacao = Solicitacao::findOrFail($id);

        $valido = $request->validate([
            'numero' => 'required|integer|min:0',
            'data_entrega' => 'required|date',
            'descricao' => 'required|string|max:150',
        ]);

        $entrega = new Entrega($valido);

        $solicitacao->entrega()->save($entrega);
    }

    public function updateEntrega(Request $request, $id){

        $request->validate([
            'numero' => 'nullable|integer|min:0',
            'data_entrega' => 'nullable|date',
            'descricao' => 'nullable|string|max:150',
            'situacao' => 'nullable|integer',
            'solicitacao_id' => 'nullable|integer|min:1'
        ]);

         $entrega = Solicitacao::findOrFail($id)->entrega;

        $solicitacaoFK = Solicitacao::find($request->usuario_id);

        if (!$solicitacaoFK and $request->solicitacao_id) {//garante que solicitacao existe
            
            return redirect()->back()->with('erro', 'não existe essa solicitacao no sistema');
        }
        if (!$entrega) {
        return redirect()->back()->with('erro', 'Entrega não encontrada para essa solicitação.');
        }



        if($request->numero){
            $entrega->numero = $request->numero;
        }

        if($request->data_entrega){
            $entrega->data_entrega = $request->data_entrega;
        }

        if($request->descricao){
            $entrega->descricao = $request->descricao;
        }

        if($request->situacao){
            $entrega->situacao = $request->situacao;
        }

        if($request->solicitacao_id){
            $entrega->solicitacao_id = $request->solicitacao_id;
        }
        $entrega->save();
    }

    public function deleteEntrega(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            Entrega::destroy($id);
            return redirect()->route('?');
        }
        
    }

}    