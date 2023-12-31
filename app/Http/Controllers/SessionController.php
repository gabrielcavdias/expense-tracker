<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    //
    public function create()
    {
        return Inertia::render('Login');
    }

    public function store(LoginRequest $request)
    {
        if(auth()->attempt($request->all())) {
            Session::put("month", date("m"));
            Session::put("year", date("Y"));

            return redirect('/');
        }

        return back()
               ->withErrors(["auth" => "Dados inválidos tente novamente"]);
    }

    public function date(Request $request)
    {
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
