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
        $solicitante = Solicitante::has('solicitacoes')->with('solicitacoes')->get();

        $solicitacoes = $solicitante->pluck('solicitacoes')->flatten();

        $totalSolicitacoes = Solicitacao::count();

        $Pendentes = Solicitacao::whereNull('resultado')->count();

        $totalEntrega = Entrega::count();

        $indeferidos = Solicitacao::where('resultado', '0')->count();

        $deferidos = Solicitacao::where('resultado', '1')->count();

        $entregues = Entrega::where('situacao', '1')->count();
        

        return view('mostrarSolicitacoesADM', [
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

    public function mostrarAnalise($id){

        $solicitacao = Solicitacao::findOrFail($id);

        $assistente = $solicitacao->user;

        $solicitante = $solicitacao->solicitante;

        return view('mostrarAnalise', ['solicitacao' => $solicitacao, 'assistente' => $assistente, 'solicitante' => $solicitante]);
    }

    public function analiseForm(Request $request, $id){

        $botao = $request->input('submit');

        $solicitacao = Solicitacao::findOrFail($id);

        if ($botao == 'deferir') {

            $solicitacao->resultado = '1';
            $solicitacao->save();
            
            return 'deferimento confirmado';
        }

        if ($botao == 'indeferir') {

            $solicitacao->resultado = '0';
            $solicitacao->save();
            
            return 'indeferimento confirmado';
        }

        return redirect()->back()->with('erro', 'erro no envio do formulario');
    }
}
