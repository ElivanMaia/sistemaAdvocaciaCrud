<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Processo</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJv+u5O1/21t9b/aK4L5e+zg5n52ZZkY94kdDmg1VV5zz00Ch2BStQKpfFJs" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .form-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 550px;
            margin: 30px auto;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9fafb;
            color: #111827;
            transition: all 0.2s ease-in-out;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            border-color: #3b82f6;
            outline: none;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .btn {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #2563eb;
        }

        @media (max-width: 600px) {
            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="icon">
                            <img src="{{ asset('assets/imgs/logo.png') }}" alt="Logo" width="54" height="54">
                        </span>
                        <span class="title">Moreira Advocacia</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Início</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('clients') }}">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agendamentos') }}">
                        <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
                        <span class="title">Agendamentos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('advogados') }}">
                        <span class="icon"><ion-icon name="hammer-outline"></ion-icon></span>
                        <span class="title">Advogados</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('processos') }}">
                        <span class="icon"><ion-icon name="document-text-outline"></ion-icon></span>
                        <span class="title">Processos</span>
                    </a>
                </li>
                <li>
                    <hr class="separator">
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Configurações</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); confirmLogout();">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sair da Conta</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle" id="menuToggle">
                    <ion-icon name="menu-outline" id="menuIcon"></ion-icon>
                </div>
                <div class="user-info" style="display: flex; align-items: center; gap: 10px;">
                    <span>{{ Auth::user()->name }}</span>
                    <div class="user">
                        <a href="{{ route('profile.edit') }}">
                            <img src="{{ asset('assets/imgs/userIcon.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $clientesCount }}</div>
                        <div class="cardName">Clientes</div>
                    </div>
                    <div class="iconBx"><ion-icon name="people-outline"></ion-icon></div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $advogadosCount }}</div>
                        <div class="cardName">Advogados</div>
                    </div>
                    <div class="iconBx"><ion-icon name="hammer-outline"></ion-icon></div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $agendamentosCount }}</div>
                        <div class="cardName">Agendamentos</div>
                    </div>
                    <div class="iconBx"><ion-icon name="calendar-outline"></ion-icon></div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $processosCount }}</div>
                        <div class="cardName">Processos</div>
                    </div>
                    <div class="iconBx"><ion-icon name="document-text-outline"></ion-icon></div>
                </div>
            </div>

            <div class="form-card">
                <h2 class="mb-4" style="font-weight: bold; padding-bottom: 10px;">Criar Processo</h2>

                @if (session()->has('message'))
                    <div class="alert alert-info">{{ session('message') }}</div>
                @endif

                <form action="{{ route('processos.store') }}" method="POST" class="form-container">
                    @csrf
                
                    <div class="input-group">
                        <label for="nome">Nome do Processo:<span style="color: red">*</span></label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o nome do processo..."
                            value="{{ old('nome') }}" required>
                        @error('nome')
                            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="input-group">
                        <label for="descricao">Descrição:<span style="color: red">*</span></label>
                        <textarea id="descricao" name="descricao" rows="3"
                            placeholder="Digite a descrição do processo...">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="input-group">
                        <label for="cliente_email">Cliente:<span style="color: red">*</span></label>
                        <select id="cliente_email" name="cliente_email" required>
                            <option value="" disabled {{ old('cliente_email') ? '' : 'selected' }}>Selecione um cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->email }}" {{ old('cliente_email') == $cliente->email ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_email')
                            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn w-100">Salvar Processo</button>
                </form>
                
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmLogout() {
            if (confirm('Tem certeza que deseja sair da conta?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>