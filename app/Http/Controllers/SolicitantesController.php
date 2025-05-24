<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitantesController extends Controller
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

       $validos = $request->validate([
            'nis' => 'required|string|max:11|unique',
            'cpf' => 'required|string|max:11|unique',
            'nome' => 'required|string|max:100',
            'sexo' => 'required|string|max:1',
            'endereco' => 'required|string|max:150',
            'cep' => 'required|string|max:8',
        ]);

        DB::tables('solicitantes')->insert($validos);
        
        DB::tables('solicitantes')->insert([
            'nis' => $request->nis,
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'sexo' => $request->sexo,
            'endereco' => $request->endereco,
            'cep' => $request->cep,
        ]);
    }
    
    public function umSolicitante($id){////////Nao sei se tem////////

        $solicitante = DB::table('solicitantes')->where('id', $id)->first(['nome', 'email']);

        if(!$solicitante){

            return redirect()->abort(404);
        }

        return inertia::render('?', ['solicitante' => $solicitante]);
    }
}
