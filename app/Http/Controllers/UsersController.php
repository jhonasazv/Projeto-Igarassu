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
        
        $user = User::orderBy('name', 'asc')->get();

        inertia::render('?', ['user' => $user]);
    }

    public function umUser($id){

        $user = User::findOrFail($id);
        inertia::render('?', ['user' => $user]);
    }

    public function updateUsers(Request $request, $id){

        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'nullable|string|max:150',
            'name' => 'nullable|string|max:150',
            'password' => ['nullable', Rules\Password::defaults()],
            'tipo' => 'nullable|string|in:assistente,administrador',
        ]);

        if($request->email){
            $user->email = $request->email;
        }

        if($request->name){
            $user->name = $request->name;
        }

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        if($request->tipo){
            $user->tipo = $request->tipo;
        }
            $user->save();
    }

    public function deleteUsers(Request $request, $id){

        $botao = $request->input('submit');

        if($botao){
            $botao = User::destroy($id);
            return redirect()->route('mostrarUsers');
        }
        
    }
}
