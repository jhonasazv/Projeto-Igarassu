<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitantesController extends Controller
{
    public function mostrarSolicitantes(){

        $solicitantes = Solicitante::orderBy('created_at')->get();

        return view('mostrarSolicitantes', ['solicitantes' => $solicitantes]);
    }

    public function mostrarSolicitantesForm(){

        return view('solicitantesForm');
     }

    public function solicitantesForm(Request $request){

        //$id = Auth::user()->id;
        $user = User::find(1);

       $validos = $request->validate([
            'nis' => 'required|string||unique:solicitantes,nis',
            'cpf' => 'required|string||unique:solicitantes,cpf',
            'nome' => 'required|string|max:100',
            'sexo' => 'required|string|size:1',
            'endereco' => 'required|string|max:150',
            'cep' => 'required|string|',
        ]);

        $solicitante = new Solicitante($validos);

        $user->solicitantes()->save($solicitante);

        return $solicitante;
    }
    
    public function umSolicitante($id){

        $solicitante = Solicitante::findOrFail($id);

        return view('umSolicitante', ['solicitante' => $solicitante]);
    }

    public function updateSolicitante(Request $request, $id){

        $request->validate([
            'nis' => 'nullable|string|size:11|unique',
            'cpf' => 'nullable|string|size:11|unique',
            'nome' => 'nullable|string|max:100',
            'sexo' => 'nullable|string|max:1',
            'endereco' => 'nullable|string|max:150',
            'cep' => 'nullable|string|size:8',
            'usuario_id' => 'nullable|integer|min:1'
        ]);

        $solicitante = Solicitante::findOrFail($id);

        $user = User::find($request->usuario_id);

        if (!$user and $request->usuario_id) {//garante que o user existe
            
            return 'não existe esse usuario no sistema';
        }

        

        if($request->nis){
            $solicitante->nis = $request->nis;
        }

        if($request->cpf){
            $solicitante->cpf = $request->cpf;
        }

        if($request->nome){
            $solicitante->nome = $request->nome;
        }

        if($request->sexo){
            $solicitante->sexo = $request->sexo;
        }

        if($request->endereco){
            $solicitante->endereco = $request->endereco;
        }

        if($request->cep){
            $solicitante->cep = $request->cep;
        }

        if($request->usuario_id){
            $solicitante->usuario_id = $request->usuario_id;
        }
            $solicitante->save();
            return $solicitante;
    }

    public function deleteSolicitantes(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            Solicitante::destroy($id);
        }
        return redirect()->route('mostrarSolicitantes');
    }
}
