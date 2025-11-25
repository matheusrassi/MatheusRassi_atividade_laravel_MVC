<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if (session('logado')) {
            return redirect('/produtos');
        }
        return view('login');
    }

    public function logar(Request $request)
    {
        if ($request->input('password') === '1234') {
            session(['logado' => true]);
            
            return redirect('/produtos');
        }

        return back()->with('erro', 'Senha incorreta!');
    }

    public function logout()
    {
        session()->forget('logado');
        return redirect('/login');
    }
}