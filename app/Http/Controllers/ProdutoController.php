<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all(); 

        return view('produtos', ['produtos' => $produtos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required'
        ]);

        $produto = new Produto();
        $produto->nome = $request->input('nome');
        $produto->save();

        return redirect('/produtos')->with('success', 'Produto salvo com sucesso!');
    }
}