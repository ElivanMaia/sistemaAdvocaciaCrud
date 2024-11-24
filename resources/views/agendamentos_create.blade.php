<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Agendamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Criar Agendamento</h1>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
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

    <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="clientes_id" id="cliente" class="form-select" required>
                <option value="" disabled selected>Selecione um cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="datetime-local" name="data" id="data" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="advogado" class="form-label">Advogado</label>
            <select name="advogados_id" id="advogado" class="form-select" required>
                <option value="" disabled selected>Selecione um advogado</option>
                @foreach($advogados as $advogado)
                    <option value="{{ $advogado->id }}">{{ $advogado->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('agendamentos') }}" class="btn btn-secondary">Retornar a página de agendamentos</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
