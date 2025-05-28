<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitantesController extends Controller
{
    public function mostrarSolicitantes(){
        //DB::table('solicitantes')->orderBy('created_at')->get(['nome', 'cpf', 'sexo', 'nis', 'cep']);

        $solicitantes = Solicitante::orderBy('created_at')->get();

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

        Solicitante::create($validos);
        
        /*DB::tables('solicitantes')->insert([
            'nis' => $request->nis,
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'sexo' => $request->sexo,
            'endereco' => $request->endereco,
            'cep' => $request->cep,
        ]);*/
    }
    
    public function umSolicitante($id){////////Nao sei se tem////////

        //$solicitante = DB::table('solicitantes')->where('id', $id)->first(['nome', 'email']);

        $solicitante = Solicitante::findOrFail($id);

        return inertia::render('?', ['solicitante' => $solicitante]);
    }

    public function updateSolicitante(Request $request, $id){

        $validos = $request->validate([
            'nis' => 'required|string|max:11|unique',
            'cpf' => 'required|string|max:11|unique',
            'nome' => 'required|string|max:100',
            'sexo' => 'required|string|max:1',
            'endereco' => 'required|string|max:150',
            'cep' => 'required|string|max:8',
        ]);

        $solicitante = Solicitante::findOrFail($id);

        if(!$request->nis == null){
            $solicitante->nis = $request->nis;
        }

        if(!$request->cpf == null){
            $solicitante->cpf = $request->cpf;
        }

        if(!$request->nome == null){
            $solicitante->nome = $request->nome;
        }

        if(!$request->sexo == null){
            $solicitante->sexo = $request->sexo;
        }

        if(!$request->endereco == null){
            $solicitante->endereco = $request->endereco;
        }

        if(!$request->cep == null){
            $solicitante->cep = $request->cep;
        }
            $solicitante->save();
    }
}
