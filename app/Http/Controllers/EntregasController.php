<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class EntregasController extends Controller
{
    public function mostrarEntregas(){

        $solicitacoes = DB::table('solicitacoes')->orderBy('created_at', 'desc')->get(['id', 'resultado', 'data_solicitacao']);

        $assistente = DB::table('users')->orderBy('created_at', 'desc')->get('nome');

        inertia::render('?', ['solicitacoes' => $solicitacoes, 'assistente' => $assistente]);
    }

    public function umaEntrega($id){

        $solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);

        $assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);

        if(!$solicitacao){

            return redirect()->abort(404);
        }

        inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    public function umaEntregaAutorizar(Request $request, $id){

        $botao = $request->input('action');

        $entrega = DB::table('entregas')->where('solicitacao_id', $id)->first();

        if(!$entrega){

            return redirect()->back()->with('erro', 'A entrega ainda não foi cadastrada');
        }

        if($entrega->situacao == 1){

            return redirect()->back()->with('erro', 'A entrega já foi autorizada');
        }

        if($botao == 'autorizar'){

            DB::table('entregas')->where('solicitacao_id', $id)->update(['situacao' => '1']);   
            return redirect()->back()->with('sucesso', 'indeferimento confirmado');
        }
    }

    public function mostrarCadastroEntrega(){

        inertia::render('?');
    }

    public function cadastroEntrega(Request $request){

        $request->validate([
            'nome' => 'string|required|max:100',
            'descricao' => 'string|required|max:100',
            'valor' => 'numeric|required|min:0',
            'quantidade' => 'integer|required|max:20',
            
            'numero' => 'integer|required|min:0',
            'data_entrega' => 'date|required',
            'descricao' => 'string|required|max:150',
        ]);

        DB::tables('auxilios')->insert([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
        ]);

        DB::tables('entregas')->insert([
            'numero' => $request->numero,
            'data_entrega' => $request->data_entrega,
            'descricao' => $request->descricao,
        ]);
    }

    /*public function mostrarCadastroAuxilio(){

        inertia::render('?');
    }

    public function cadastroAuxilio(Request $request){//////////TALVEZ SEJA REDUZIDO A UM SO

        $request->validate([
            'nome' => 'string|required|max:100',
            'descricao' => 'string|required|max:100',
            'valor' => 'numeric|required|min:0',
            'quantidade' => 'integer|required|max:20'
        ]);

        DB::tables('auxilios')->insert([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
        ]);
    }

    public function mostrarCadastroEntrega(){

        inertia::render('?');
    }

    public function cadastroEntrega(Request $request){//////////TALVEZ SEJA REDUZIDO A UM SO

        $request->validate([
            'numero' => 'integer|required|min:0',
            'data_entrega' => 'date|required',
            'descricao' => 'string|required|max:150',
            'situacao' => 'integer|required'//////Enum talvez
        ]);

        DB::tables('entregas')->insert([
            'numero' => $request->numero,
            'data_entrega' => $request->data_entrega,
            'descricao' => $request->descricao,
            'situacao' => $request->situacao,
        ]);
    }*/

}
