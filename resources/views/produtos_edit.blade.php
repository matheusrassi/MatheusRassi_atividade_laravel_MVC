<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: auto; padding: 20px; }
        form { border: 1px solid #ccc; padding: 20px; border-radius: 5px; }
        input, button { padding: 10px; margin-top: 5px; width: 100%; box-sizing: border-box; }
        button { background-color: #ffc107; color: black; border: none; cursor: pointer; font-weight: bold;}
        .back-link { display: block; margin-bottom: 15px; color: #007bff; text-decoration: none;}
    </style>
</head>
<body>
    <a href="/produtos" class="back-link">← Voltar para a lista</a>

    <h1>Editar Produto</h1>

    <form action="/produtos/{{ $produto->id }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" value="{{ $produto->nome }}" required>

        <button type="submit">Atualizar Produto</button>
    </form>
</body>
</html>