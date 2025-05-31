<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function mostrarAgenda(){

        inertia::render('?');
    }

    public function agendaForm(Request $request){

        $valido = $request->validate([
            'descricao' => 'required|string|max:150',
            //'situacao' => 'required|string|max:15|in:deferido,indeferido'
        ]);

        Agendamento::create($valido);
    }

    public function updateAgendamento(Request $request, $id){

        $request->validate([
            'descricao' => 'nullable|string|max:150',
            'situacao' => 'nullable|integer',
            'data_agendamento' => 'nullable|date',
            'solicitante_id' => 'nullable|integer|min:1',
            'usuario_id' => 'nullable|integer|min:1'
        ]);

        $agendamento = Agendamento::findOrFail($id);

        $user = User::find($request->usuario_id);

        $solicitante = Solicitante::find($request->solicitante_id);

        if (!$user and $request->usuario_id) {
            return redirect()->back()->with('erro', 'não existe esse usuario no sistema');
        }

        if (!$solicitante and $request->solicitante_id) {
            return redirect()->back()->with('erro', 'não existe esse solicitante no sistema');
        }



        if(!$request->descricao == null){
            $agendamento->descricao = $request->descricao;
        }

        if(!$request->situacao == null){
            $agendamento->situacao = $request->situacao;
        }

        if(!$request->data_agendamento == null){
            $agendamento->data_agendamento = $request->data_agendamento;
        }

        if(!$request->solicitante_id == null){
            $agendamento->solicitante_id = $request->solicitante_id;
        }

        if(!$request->usuario_id == null){
            $agendamento->usuario_id = $request->usuario_id;
        }
    }

    public function deleteAgendamento(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            Agendamento::destroy($id);
        }
        return redirect()->back();
    }

}
