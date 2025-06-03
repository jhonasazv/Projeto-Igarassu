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
        $solicitacoes = Solicitacao::orderBy('created_at', 'asc')->get();

        $solicitante = Solicitante::orderBy('created_at', 'asc')->get();

        $totalSolicitacoes = Solicitacao::count();

        $Pendentes = Solicitacao::whereNull('resultado')->count();

        $totalEntrega = Entrega::count();

        $indeferidos = Solicitacao::where('resultado', 'false')->count();

        $deferidos = Solicitacao::where('resultado', 'true')->count();

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

    public function mostrarAnalise($id){

        $solicitacao = Solicitacao::findOrFail($id);

        $assistente = Solicitacao::findOrFail($id)->user;

        inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }

    public function analiseForm(Request $request, $id){

        $botao = $request->input('action');

        $solicitacao = Solicitacao::findOrFail($id);
        
        if ($botao == 'deferir') {

            $solicitacao->resultado = 'true';
            $solicitacao->save();
            
            return redirect()->back()->with('sucesso', 'deferimento confirmado');
        }

        if ($botao == 'indeferir') {

            $solicitacao->resultado = 'false';
            $solicitacao->save();
            
            return redirect()->back()->with('sucesso', 'indeferimento confirmado');
        }

        return redirect()->back()->with('erro', 'erro no envio do formulario');
    }
}
