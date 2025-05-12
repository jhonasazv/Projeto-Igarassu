<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Http\Request;

class semLogincontroller extends Controller
{
    public function mostrarAgenda(){

        inertia::render('?');
    }

    public function agendaForm(Request $request){

        $request->validate([
            'descricao' => 'required|string|max:150',
            //'situacao' => 'required|string|max:15|in:deferido,indeferido'
        ]);

        DB::tables('agendamento')->insert([
            'descricao' => $request->descricao,
        ]);
    }
}
