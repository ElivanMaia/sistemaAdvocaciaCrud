<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Clientes</title>

    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJv+u5O1/21t9b/aK4L5e+zg5n52ZZkY94kdDmg1VV5zz00Ch2BStQKpfFJs" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- ======= CSS do Formulário ======= -->
    <style>
        .form-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
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
                        <span class="title">Sistema de Agendamento</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Início</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('clients') }}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Clientes</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('agendamentos') }}">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Agendamentos</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('advogados') }}">
                        <span class="icon">
                            <ion-icon name="hammer-outline"></ion-icon>
                        </span>
                        <span class="title">Advogados</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('processos') }}">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Processos</span>
                    </a>
                </li>

                <li>
                    <hr class="separator">
                </li>

                <li>
                    <a href="{{ route('profile.edit') }}">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Configurações</span>
                    </a>
                </li>

                <li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ $advogadosCount }}</div>
                        <div class="cardName">Advogados</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="hammer-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ $agendamentosCount }}</div>
                        <div class="cardName">Agendamentos</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ $processosCount }}</div>
                        <div class="cardName">Processos</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="document-text-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ==================== Formulário ==================== -->
            <div class="form-card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 style="padding-bottom: 10px">Cadastrar Cliente</h2>
                <form action="{{ route('clients.store') }}" method="POST" class="form-container">
                    @csrf
                    <div class="input-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o nome do cliente" required>
                    </div>
                    <div class="input-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" placeholder="Digite o e-mail do cliente" required>
                    </div>
                    <div class="input-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" placeholder="Digite o telefone" required>
                    </div>
                    <div class="input-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" placeholder="Digite o CPF" required>
                    </div>
                    <div class="input-group">
                        <label for="data_nasc">Data de Nascimento:</label>
                        <input type="date" id="data_nasc" name="data_nasc" required>
                    </div>
                    <button type="submit" class="btn">Cadastrar Cliente</button>
                </form>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        setTimeout(() => {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    <script>
        $(document).ready(function () {
            $('#telefone').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00');

            let today = new Date().toISOString().split('T')[0];
            document.getElementById("data_nasc").setAttribute("max", today);
        });
    </script>
    <script src="../js/main.js"></script>


    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>