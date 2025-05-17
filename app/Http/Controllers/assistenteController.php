<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class assistenteController extends Controller
{
    public function mostrarSolicitantes(){

        //$solicitantes = DB::table('solicitantes')->orderBy('created_at')->get([]);

        $solicitantes = DB::table('users')->orderBy('created_at')->get(['name', 'email']);//nao é [nome e email]

        return inertia::render('?', $solicitantes);
    }

    public function mostrarSolicitantesForm(){

        /* $user = Auth::user();
        $email = $user->email;

        $assistenteId = DB::table('users')->where('email', $email)->get(['name', 'email']);

        session('idAssistente', $assistenteId); */

        return inertia::render('?');
     }

    public function solicitantesForm(Request $request){

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

    public function mostrarSolicitacao(){

        $solicitacoes = DB::table('users')->orderBy('created_at')->get(['name', 'email']);//nao é [nome e email]

        return inertia::render('?', $solicitacoes);
    }

    public function mostrarSolicitacaoForm(){

        return inertia::render('?');
    }

    public function solicitacaoForm(Request $request){
        
        $request->validate([
            'descricao' => 'required|string|max:150',
        ]);

        DB::table('solicitacao')->insert([
            'texto' => $request->descricao
        ]);
    }

    public function umSolicitante($id){

        $dataSolicitante = DB::table('solicitantes')->where('id', $id)->get(['name', 'email']);

        return inertia::render('?', $dataSolicitante);
    }

    public function umaSolicitacao($id){

        $dataSolicitacao = DB::table('solicitacoes')->where('id', $id)->get(['name', 'email']);

        return inertia::render('?', $dataSolicitacao);
    }
}
