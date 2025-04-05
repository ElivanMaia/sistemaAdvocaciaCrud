<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Advogado</title>
    <!-- Bootstrap -->
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

            <h2>Editar Advogado</h2>
            <form action="{{ route('advogados.update', ['advogado' => $advogado->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-2">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $advogado->nome }}"
                        required>
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $advogado->email }}"
                        required>
                </div>

                <div class="mb-2">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone"
                        value="{{ $advogado->telefone }}" required>
                </div>

                <div class="mb-2">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $advogado->cpf }}" required>
                </div>

                <div class="mb-2">
                    <label for="area_atuacao" class="form-label">Area de atuação</label>
                    <input type="text" class="form-control" id="area_atuacao" name="area_atuacao"
                        value="{{ $advogado->area_atuacao }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                <a href="{{ route('advogados') }}" class="btn btn-secondary">Retornar a página de advogados</a>

            </form>

        </div>
    </div>

    <!-- script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#telefone').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00');
        });
    </script>
</body>

</html>