<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return Inertia::render('Register');
    }

    public function store(RegisterRequest $request)
    {
        try {
            $user = User::create($request->all());
            event(new Registered($user));
            return redirect()->route('login.create')->with('success', "Usuário registrado com sucesso");

        } catch(Exception $error) {
            Log::error("Erro ao registrar usuário: ", [$error->getMessage()]);
            return back()->withErrors(["Falha ao registrar usuário, por favor tente novamente."]);
        }
    }
}
