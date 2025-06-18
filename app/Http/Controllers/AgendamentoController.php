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
    public function mostrarAgendaForm(){

        inertia::render('?');
    }

    public function agendaForm(Request $request){//relacao decidida no update

        $valido = $request->validate([
            'descricao' => 'required|string|max:150',
        ]);

        Agendamento::create($valido);
    }

    public function mostrarAgendamentos(){

        $agendamentos = Agendamento::orderBy('created_at', 'asc')->get();

        inertia::render('?', ['agendamentos' => $agendamentos]);
    }

    public function umAgendamento($id){

        $agendamento = Agendamento::findOrfail($id);

        inertia::render('?', ['agendamento' => $agendamento]);
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

        $userFK = User::find($request->usuario_id);

        $solicitanteFK = Solicitante::find($request->solicitante_id);

        if (!$userFK and $request->usuario_id) {//garante que o user existe
            
            return redirect()->back()->with('erro', 'não existe esse usuario no sistema');
        }

        if (!$solicitanteFK and $request->solicitante_id) {//garante que o user existe
            
            return redirect()->back()->with('erro', 'não existe esse solicitante no sistema');
        }



        if($request->descricao){
            $agendamento->descricao = $request->descricao;
        }

        if($request->situacao){
            $agendamento->situacao = $request->situacao;
        }

        if($request->data_agendamento){
            $agendamento->data_agendamento = $request->data_agendamento;
        }

        if($request->solicitante_id){
            $agendamento->solicitante_id = $request->solicitante_id;
        }

        if($request->usuario_id){
            $agendamento->usuario_id = $request->usuario_id;
        }
         $agendamento->save();
    }

    public function deleteAgendamento(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            Agendamento::destroy($id);
            return redirect()->route('?');
        }
    }
}
