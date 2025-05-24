<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AnaliseController extends Controller
{
    public function motrarSolicitacoesADM(){

        $solicitacoes = DB::table('solicitacoes')->orderBy('created_at', 'desc')->get(['id', 'resultado', 'data_solicitacao']);

        $solicitante = DB::table('solicitantes')->orderBy('created_at', 'desc')->get('nome');

        $totalSolicitacoes = DB::table('solicitacoes')->count();

        $Pendentes = DB::table('solicitacoes')->whereNull('resultado')->count();

        $totalEntrega = DB::table('entregas')->count();

        $indeferidos = DB::table('solicitacoes')->where('resultado', 'false')->count();

        $deferidos = DB::table('solicitacoes')->where('resultado', 'true')->count();

        $entregues = DB::table('entregas')->where('situacao', '0')->count();

        inertia::render('?', [
            'solicitacoes' => $solicitacoes,
            'solicitante' => $solicitante,
            'totalSolicitacoes' => $totalSolicitacoes, 
            'Pendentes' => $Pendentes, 
            'totalEntrega' => $totalEntrega, 
           'indeferidos' => $indeferidos, 
            'deferidos' => $deferidos, 
            'entregues' => $entregues
        ]);
    }

    public function mostrarAnalise($id){//abortar quando for o id errado

        $solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);

        $assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);

        if(!$solicitacao){

            return redirect()->abort(404);
        }

        inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    public function analiseForm(Request $request, $id){

        $botao = $request->input('action');
        
        if ($botao == 'deferir') {

            DB::table('solicitacoes')->where('id', $id)->update(['resultado' => 'true']);
            return redirect()->back()->with('sucesso', 'deferimento confirmado');
        }

        if ($botao == 'indeferir') {

            DB::table('solicitacoes')->where('id', $id)->update(['resultado' => 'false']);   
            return redirect()->back()->with('sucesso', 'indeferimento confirmado');
        }

        return redirect()->back()->with('erro', 'erro no envio do formulario');
    }
}
