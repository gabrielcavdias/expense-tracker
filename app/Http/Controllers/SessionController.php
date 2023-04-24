<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            Session::put("month", date("m"));
            Session::put("year", date("Y"));
            
            return redirect('/');
        }

        return back()
        ->withErrors(["auth" => "Dados inválidos tente novamente"]);
    }

    public function date(Request $request){
        Session::put("month", $request->month);
    }


    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return to_route('login.create');
    }
}
