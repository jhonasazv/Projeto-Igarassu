<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use App\Models\Solicitante;
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
            'descricao' => 'required|string|max:320',
        ]);

        Solicitacao::create([
            'texto' => $request->descricao//!!!!!!!!
        ]);

        /*DB::table('solicitacao')->insert([
            'texto' => $request->descricao
        ]);*/
    }

    public function umaSolicitacao($id){

        //$solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);

        $solicitacao = Solicitacao::findOrFail($id);

        //$assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);/////////ver se ta certo

        $assistente = Solicitacao::findOrFail($id)->user;

        return inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    /////////////
    //
    ////////////// Parte do administrador
    //
    /////////////
}
