<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página de Produtos</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: auto; padding: 20px; transition: background 0.3s, color 0.3s; }
        
        body.dark-mode { background-color: #121212; color: #ffffff; }
        body.dark-mode li { background-color: #1e1e1e; border-color: #333; }
        body.dark-mode form { border-color: #333; background-color: #1e1e1e; }
        body.dark-mode input { background-color: #333; color: white; border: 1px solid #555; }
        
        form { border: 1px solid #ccc; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        input, button { padding: 10px; margin-top: 5px; width: 100%; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        ul { list-style-type: none; padding: 0; }
        li { background-color: #f9f9f9; border: 1px solid #ddd; padding: 10px; margin-bottom: 5px; }
    </style>
</head>

<body class="{{ \Illuminate\Support\Facades\Cookie::get('tema') == 'dark' ? 'dark-mode' : '' }}">

    <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Produtos</h1>
    
    <div style="display: flex; gap: 15px;">
            <a href="/trocar-tema" style="text-decoration: none; font-size: 20px;">
                {{ \Illuminate\Support\Facades\Cookie::get('tema') == 'dark' ? 'Modo Claro ☀️' : 'Modo Escuro 🌙' }}
            </a>

            <a href="/logout" style="text-decoration: none; font-size: 16px; color: red; font-weight: bold; padding-top: 5px;">
                Sair 🚪
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="/produtos" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required>
        <label for="foto" style="margin-top: 10px; display:block;">Foto do Produto (PNG ou JPG):</label>
        <input type="file" id="foto" name="foto" accept="image/png, image/jpeg">
        <button type-="submit">Salvar Produto</button>
    </form>

    <hr>

    <h2>Lista de Produtos</h2>
    <ul>
        @forelse ($produtos as $produto)
            <li style="display: flex; justify-content: space-between; align-items: center;">
                
                <div style="display: flex; align-items: center; gap: 10px;">
                    @if($produto->foto)
                        <img src="{{ asset('storage/' . $produto->foto) }}" alt="Foto" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                    @endif

                    <span>{{ $produto->nome }}</span>
                </div>

                <div style="display: flex; gap: 10px;">
                    <a href="/produtos/{{ $produto->id }}/edit" style="background-color: #ffc107; color: black; padding: 10px; text-decoration: none; border-radius: 2px; font-size: 13.33px; border: 1px solid gray;">Editar</a>

                    <form action="/produtos/{{ $produto->id }}" method="POST" onsubmit="return confirm('Tem certeza?');" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: red; margin-left: 0;">Excluir</button>
                    </form>
                </div>

            </li>
        @empty
            <li>Nenhum produto cadastrado.</li>
        @endforelse
    </ul>

</body>
</html>