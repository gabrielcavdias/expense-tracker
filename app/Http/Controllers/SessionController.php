<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
    //
    public function create(){
        return Inertia::render('Login');
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($credentials)){
            return to_route('home');
        }

        return back()
        ->withErrors(["auth" => "Dados inválidos tente novamente"]);
    }


    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return to_route('login.create');
    }
}
