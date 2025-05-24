<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SolicitacoesController extends Controller
{
    public function mostrarSolicitacao(){

        $solicitante = DB::table('solicitantes')->orderBy('created_at', 'desc')->get('nome');

        $solicitacoes = DB::table('solicitacoes')->orderBy('created_at', 'desc')->get(['id', 'resultado', 'data_solicitacao']);

        return inertia::render('?', ['solicitante' => $solicitante, 'solicitacoes', $solicitacoes]);
    }

    public function mostrarSolicitacaoForm(){

        return inertia::render('?');
    }

    public function solicitacaoForm(Request $request){
        
        $request->validate([
            'descricao' => 'required|string|max:320',
        ]);

        DB::table('solicitacao')->insert([
            'texto' => $request->descricao
        ]);
    }

    public function umaSolicitacao($id){

        $solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);

        $assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);/////////ver se ta certo

        //$solicitante = DB::table('solicitantes')->where('id', $dataSolicitacao->usuario_id)->first(['id']);

        if(!$solicitacao){

            return redirect()->abort(404);
        }

        return inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    /////////////
    //
    ////////////// Parte do administrador
    //
    /////////////
}
