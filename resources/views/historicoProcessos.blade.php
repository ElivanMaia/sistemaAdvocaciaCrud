<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Processos</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            padding: 6px 12px;
            text-decoration: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
        }

        td a:hover {
            background-color: #218838;
        }

        .btn-danger {
            padding: 6px 14px;
            text-decoration: none;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            border: none;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li><a href="{{ route('dashboard') }}"><span class="icon"><ion-icon
                                name="home-outline"></ion-icon></span><span class="title">Início</span></a></li>
                <li><a href="{{ route('clients') }}"><span class="icon"><ion-icon
                                name="people-outline"></ion-icon></span><span class="title">Clientes</span></a></li>
                <li><a href="{{ route('agendamentos') }}"><span class="icon"><img
                                src="{{ asset('assets/imgs/calendar.png') }}" alt="Logo" width="32"
                                height="32"></span><span class="title">Agendamentos</span></a></li>
                <li><a href="{{ route('advogados') }}"><span class="icon"><img
                                src="{{ asset('assets/imgs/successProcess.png') }}" alt="Logo" width="32"
                                height="32"></span><span class="title">Advogados</span></a></li>
                <li><a href="{{ route('processos') }}"><span class="icon"><img
                                src="{{ asset('assets/imgs/successProcess.png') }}" alt="Logo" width="32"
                                height="32"></span><span class="title">Processos</span></a></li>
                <li><a href="{{ route('profile.edit') }}"><span class="icon"><ion-icon
                                name="settings-outline"></ion-icon></span><span class="title">Configurações</span></a>
                </li>
                <li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span
                            class="icon"><ion-icon name="log-out-outline"></ion-icon></span><span class="title">Sair da
                            Conta</span></a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
                <div class="user"><a href="{{ route('profile.edit') }}"><img
                            src="{{ asset('assets/imgs/userIcon.png') }}" alt=""></a></div>
            </div>

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
                        <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">R$ {{ number_format($lucro) }}</div>
                        <div class="cardName">Lucro</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="recentOrders">
            @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


                @if ($historicoProcessos->isEmpty())
                    <p>Nenhum processo excluído registrado.</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Nome do Processo</th>
                                <th>Histórico</th>
                                <th>Data da Exclusão</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historicoProcessos as $historico)
                                <tr>
                                    <td>{{ $historico->processo_nome }}</td>
                                    <td>{{ $historico->historico }}</td>
                                    <td>{{ $historico->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('processos.restore', $historico->id) }}"
                                            class="btn btn-success">Restaurar</a>
                                        <form action="{{ route('processoshistorico.destroy', $historico->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Deletar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script>
    setTimeout(() => {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>