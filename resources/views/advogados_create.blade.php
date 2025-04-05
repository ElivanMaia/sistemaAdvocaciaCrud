<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Advogado</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div style="background-image: url('assets/imgs/background.png')">
        <div class="container mt-5">
            @if (session()->has('message'))
                {{ session()->get('message') }}
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2>Editar Cliente</h2>
            <form action="{{ route('advogados.store') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-2">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>

                <div class="mb-2">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>

                <div class="mb-2">
                    <label for="area_atuacao" class="form-label">Area de atuação</label>
                    <input type="text" class="form-control" id="area_atuacao" name="area_atuacao" required>
                </div>

                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                <a href="{{ route('advogados') }}" class="btn btn-secondary">Retornar a página de advogados</a>

            </form>

        </div>
    </div>

    <!-- Link para os scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>