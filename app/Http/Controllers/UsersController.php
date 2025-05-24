<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function mostrarUsers(){
        
        $user = DB::table('users')->orderBy('name', 'asc')->get(['email', 'nome', 'tipo', 'id']);

        inertia::render('?', ['user' => $user]);
    }
}
