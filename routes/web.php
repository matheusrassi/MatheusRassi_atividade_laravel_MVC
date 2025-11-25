<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Middleware\Autenticacao;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'logar']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::redirect('/', '/login');

Route::get('/trocar-tema', function () {
    $temaAtual = \Illuminate\Support\Facades\Cookie::get('tema', 'light');
    $novoTema = ($temaAtual == 'light') ? 'dark' : 'light';
    return back()->withCookie(cookie('tema', $novoTema, 60));
});

Route::middleware(Autenticacao::class)->group(function () {

    Route::get('/produtos', [ProdutoController::class, 'index']);
    Route::post('/produtos', [ProdutoController::class, 'store']);
    Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit']);
    Route::put('/produtos/{id}', [ProdutoController::class, 'update']);
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy']);

    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::post('/categorias', [CategoriaController::class, 'store']);

});