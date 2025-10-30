<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias', ['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required'
        ]);

        $categoria = new Categoria();
        $categoria->nome = $request->input('nome');
        $categoria->save();

        return redirect('/categorias')->with('success', 'Categoria salva com sucesso!');
    }
}