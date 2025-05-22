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

        $solicitantes = DB::table('solicitantes')->orderBy('created_at')->get(['nome', 'cpf', 'sexo', 'nis', 'cep']);//nao é [nome e email]

        return inertia::render('?', ['solicitantes' => $solicitantes]);
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

        $solicitante = DB::table('solicitantes')->orderBy('created_at', 'desc')->get('nome');

        $solicitacoes = DB::table('solicitacoes')->orderBy('created_at', 'desc')->get(['id', 'resultado', 'data_solicitacao']);

        return inertia::render('?', ['solicitante' => $solicitante, 'solicitacoes', $solicitacoes]);
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

    public function umSolicitante($id){////////Nao sei se tem////////

        $solicitante = DB::table('solicitantes')->where('id', $id)->first(['nome', 'email']);

        if(!$solicitante){

            return redirect()->abort(404);
        }

        return inertia::render('?', ['solicitante' => $solicitante]);
    }

    public function umaSolicitacao($id){

        $solicitacao = DB::table('solicitacoes')->where('id', $id)->first(['data_solicitacao', 'data_deferido', 'resultado', 'texto', 'id', 'usuario_id']);

        $assistente = DB::table('users')->where('id', $solicitacao->usuario_id)->first(['nome']);/////////ver se ta certo

        //$solicitante = DB::table('solicitantes')->where('id', $dataSolicitacao->usuario_id)->first(['id']);

        if(!$solicitacao){

            return redirect()->abort(404);
        }

        return inertia::render('?', ['solicitacao' => $solicitacao, 'assistente' => $assistente]);
    }
}
