<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Http\Request;

class assistenteController extends Controller
{
    public function mostrarSolicitantes(){

        //$solicitantes = DB::table('solicitantes')->orderBy('created_at')->get([]);

        $solicitantes = DB::table('users')->orderBy('created_at')->get(['name', 'email']);

        return response()->json($solicitantes);
    }

    public function solicitacaoForm(Request $request){

        $request->validate([
            'nis' => 'required|string|max:150|unique',
            'cpf' => 'required|string|max:20|unique',
            'nome' => 'required|string|max:100',
            'sexo' => 'required|string|max:1',
            'endereco' => 'required|string|max:50',
            'cep' => 'required|string|max:8',
        ]);

        DB::tables('solicitantes')->insert([
            'nis' => $request->nis,
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'sexo' => $request->sexo,
            'endereco' => $request->endereco,
            'cep' => $request->cep,
        ]);
    }
}
