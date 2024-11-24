<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div style="background-image: url('assets/imgs/background.png')">
    <div class="container mt-5">
    @if (session()->has('message'))
            <div class="alert alert-info">
                {{ session()->get('message') }}
            </div>
        @endif

        @if ($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
        @endif

        <h2>Cadastrar Cliente</h2>
        <form action="{{ route('clients.store') }}" method="POST">
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
        <label for="data_nasc" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar alterações</button>
<a href="{{ route('clients') }}" class="btn btn-secondary">Retornar a página de clientes</a>

</form>

    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
