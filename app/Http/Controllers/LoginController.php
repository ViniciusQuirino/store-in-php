<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $credenciais = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            ['email.required' => 'O campo email é obrigatório', 'email.email' => 'O email não é válido', 'password.required' => 'O campo senha é obrigatório'],
        );

        if (Auth::attempt($credenciais, $request->remember)) {
            $request->session()->regenerate();
            flash()->addSuccess('Usuário logado');
            return redirect()->intended('/');
        } else {
            flash()->addError('Email ou senha incorretos.');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('public.home');
    }
}