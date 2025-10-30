<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página de Produtos</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: auto; padding: 20px; }
        form { border: 1px solid #ccc; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        input, button { padding: 10px; margin-top: 5px; width: 100%; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        ul { list-style-type: none; padding: 0; }
        li { background-color: #f9f9f9; border: 1px solid #ddd; padding: 10px; margin-bottom: 5px; }
    </style>
</head>
<body>
    <h1>Produtos</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="/produtos" method="POST">
        @csrf
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required>
        <button type-="submit">Salvar Produto</button>
    </form>

    <hr>

    <h2>Lista de Produtos</h2>
    <ul>
        @forelse ($produtos as $produto)
            <li>{{ $produto->nome }}</li>
        @empty
            <li>Nenhum produto cadastrado.</li>
        @endforelse
    </ul>

</body>
</html>