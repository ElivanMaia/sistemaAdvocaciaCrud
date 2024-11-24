<div class="container">
    <h1>Editar Agendamento</h1>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" class="form-control" id="data" name="data" value="{{ $agendamento->data }}" required>
        </div>
        <div class="mb-3">
            <label for="descrição" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" required>{{ $agendamento->descricao }}</textarea>
        </div>
        <div class="mb-3">
            <label for="clientes_id" class="form-label">Cliente</label>
            <select class="form-select" id="clientes_id" name="clientes_id" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ $agendamento->clientes_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="advogados_id" class="form-label">Advogado</label>
            <select class="form-select" id="advogados_id" name="advogados_id" required>
                @foreach ($advogados as $advogado)
                    <option value="{{ $advogado->id }}" 
                        {{ $agendamento->advogados_id == $advogado->id ? 'selected' : '' }}>
                        {{ $advogado->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('agendamentos') }}" class="btn btn-secondary">Retornar a página de agendamentos</a>
    </form>
</div>