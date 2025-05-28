<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function mostrarUsers(){
        
        //$user = DB::table('users')->orderBy('name', 'asc')->get(['email', 'nome', 'tipo', 'id']);

        $user = User::orderBy('name', 'asc')->get();


        inertia::render('?', ['user' => $user]);
    }

    public function updateUsers(Request $request, $id){

        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'nullable|string|max:150',
            'name' => 'nullable|string|max:150',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tipo' => 'required|string|max:15|in:assistente,administrador',
        ]);

        if(!$request->email == null){
            $user->email = $request->email;
        }

        if(!$request->name == null){
            $user->name = $request->name;
        }

        if(!$request->password == null){
            $user->password = Hash::make($request->password);
        }

        if(!$request->tipo == null){
            $user->tipo = $request->tipo;
        }
            $user->save();
    }

    public function deleteUsers(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            $botao = User::destroy($id);
        }
        return redirect()->back();
    }
}
