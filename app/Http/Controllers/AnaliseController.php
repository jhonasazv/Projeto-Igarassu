<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AnaliseController extends Controller
{
    public function motrarSolicitacoesADM(){

        //$solicitacoes = DB::table('solicitacoes')->orderBy('created_at', 'desc')->get(['id', 'resultado', 'data_solicitacao']);
        $solicitacoes = Solicitacao::orderBy('created_at', 'asc')->get();

        //$solicitante = DB::table('solicitantes')->orderBy('created_at', 'desc')->get('nome');
        $solicitante = Solicitante::orderBy('created_at', 'asc')->get();

        //$totalSolicitacoes = DB::table('solicitacoes')->count();
        $totalSolicitacoes = Solicitacao::count();

        //$Pendentes = DB::table('solicitacoes')->whereNull('resultado')->count();
        $Pendentes = Solicitacao::whereNull('resultado')->count();

        //$totalEntrega = DB::table('entregas')->count();
        $totalEntrega = Entrega::count();

        //$indeferidos = DB::table('solicitacoes')->where('resultado', 'false')->count();
        $indeferidos = Solicitacao::where('resultado', 'false')->count();

        //$deferidos = DB::table('solicitacoes')->where('resultado', 'true')->count();
        $deferidos = Solicitacao::where('resultado', 'true')->count();

        //$entregues = DB::table('entregas')->where('situacao', '0')->count();
        $entregues = Entrega::where('situacao', '1')->count();
        

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

        //$solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);
        $solicitacao = Solicitacao::findOrFail($id);

        //$assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);
        $assistente = Solicitacao::findOrFail($id)->user;

        inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    public function analiseForm(Request $request, $id){

        $botao = $request->input('action');

        $solicitacao = Solicitacao::findOrFail($id);
        
        if ($botao == 'deferir') {

            //DB::table('solicitacoes')->where('id', $id)->update(['resultado' => 'true']);
            $solicitacao->resultado = 'true';
            $solicitacao->save();
            
            return redirect()->back()->with('sucesso', 'deferimento confirmado');
        }

        if ($botao == 'indeferir') {

            //DB::table('solicitacoes')->where('id', $id)->update(['resultado' => 'false']); 
            $solicitacao->resultado = 'false';
            $solicitacao->save();
            
            return redirect()->back()->with('sucesso', 'indeferimento confirmado');
        }

        return redirect()->back()->with('erro', 'erro no envio do formulario');
    }
}
