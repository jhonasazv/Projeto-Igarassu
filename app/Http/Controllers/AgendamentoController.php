<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
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
}
