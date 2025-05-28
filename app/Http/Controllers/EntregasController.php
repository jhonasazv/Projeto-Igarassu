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

        $entrega = Entrega::findOrFail($id);

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

    public function cadastroEntrega(Request $request){//TESTAR

        $request->validate([
            'nome' => 'string|required|max:100',
            'descricao' => 'string|required|max:100',
            'valor' => 'numeric|required|min:0',
            'quantidade' => 'integer|required|max:20',
            
            'numero' => 'integer|required|min:0',
            'data_entrega' => 'date|required',
            'descricao' => 'string|required|max:150',
        ]);
 
        auxilio::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
        ]);

        /*DB::tables('auxilios')->insert([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
        ]);*/

        Entrega::create([
            'numero' => $request->numero,
            'data_entrega' => $request->data_entrega,
            'descricao' => $request->descricao,
        ]);

        /*DB::tables('entregas')->insert([
            'numero' => $request->numero,
            'data_entrega' => $request->data_entrega,
            'descricao' => $request->descricao,
        ]);*/
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
