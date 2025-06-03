<?php

namespace App\Http\Controllers;

use App\Models\auxilio;
use App\Models\Entrega;
use App\Models\Solicitacao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class EntregasController extends Controller
{
    public function mostrarEntregas(){

        //$solicitacoes = DB::table('solicitacoes')->orderBy('created_at', 'desc')->get(['id', 'resultado', 'data_solicitacao']);

        $solicitacoes = Solicitacao::orderBy('created_at', 'asc')->get();

        //$assistente = DB::table('users')->orderBy('created_at', 'desc')->get('nome');

        $assistente = User::orderBy('created_at', 'asc')->get();

        inertia::render('?', ['solicitacoes' => $solicitacoes, 'assistente' => $assistente]);
    }

    public function umaEntrega($id){

        //$solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);

        $solicitacao = Solicitacao::findOrFail($id);

        //$assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);

        $assistente = Solicitacao::findOrFail($id)->user;

        inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    public function umaEntregaAutorizar(Request $request, $id){//NAO SEI SE ESTA PEGANDO

        $botao = $request->input('action');

        //$entrega = DB::table('entregas')->where('solicitacao_id', $id)->first();

        $entrega = Solicitacao::findOrFail($id)->entrega;

        if(!$entrega){

            return redirect()->back()->with('erro', 'A entrega ainda não foi cadastrada');
        }

        if($entrega->situacao == 1){

            return redirect()->back()->with('erro', 'A entrega já foi autorizada');
        }

        if($botao == 'autorizar'){

            //DB::table('entregas')->where('solicitacao_id', $id)->update(['situacao' => '1']);   
            $entrega->situacao = 1;
            $entrega->save();

            return redirect()->back()->with('sucesso', 'indeferimento confirmado');
        }
    }

    public function mostrarCadastroEntrega(){

        inertia::render('?');
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

        $entrega = Entrega::findOrFail($id);

        $solicitacao = Solicitacao::find($request->usuario_id);

        if (!$solicitacao and $request->solicitacao_id) {
            
            return redirect()->back()->with('erro', 'não existe essa solicitacao no sistema');
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
    }

    public function deleteEntrega(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            Entrega::destroy($id);
        }
        return redirect()->back();
    }

}    