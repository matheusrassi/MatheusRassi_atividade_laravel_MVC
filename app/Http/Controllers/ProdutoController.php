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
            'nome' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $produto = new Produto();
        $produto->nome = $request->input('nome');

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $caminhoImagem = $request->file('foto')->store('produtos', 'public');
            $produto->foto = $caminhoImagem;
        }

        $produto->save();

        return redirect('/produtos')->with('success', 'Produto salvo com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        $produto->delete();

        return redirect('/produtos')->with('success', 'Produto excluído com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos_edit', ['produto' => $produto]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required'
        ]);

        $produto = Produto::findOrFail($id);
        $produto->nome = $request->input('nome');
        $produto->save();

        return redirect('/produtos')->with('success', 'Produto atualizado com sucesso!');
    }
}