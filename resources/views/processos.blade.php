<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processos</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJgK5w6g7Xy1YXwT7r7/oH6tElQ5paI7B55z4Z1Be12oP1Rxa7yRJisVsZgg" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


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

            <!-- ================ Ver Histórico ================ -->
            <div class="button-container">
                <a href="{{ route('historicoProcessos') }}" class="historico-btn">
                    Ver Histórico
                </a>
            </div>


            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    @if (session()->has('success') || session()->has('error') || session()->has('info'))
                        <div class="container mt-3">
                            @foreach (['success', 'error', 'info'] as $msg)
                                @if (session()->has($msg))
                                    <div id="alert-{{ $msg }}"
                                        class="alert alert-{{ $msg == 'error' ? 'danger' : $msg }} alert-dismissible fade show"
                                        role="alert">
                                        <span>{{ session($msg) }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Fechar"></button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <div class="cardHeader">
                        <h2>Processos</h2>
                        <a href="{{ route('processos.create') }}" class="btn">Novo Processo</a>
                    </div>

                    @if ($processos->isEmpty())
                        <p class="no-data">Nenhum processo adicionado.</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome do Processo</td>
                                    <td>Descrição</td>
                                    <td>Cliente</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($processos as $processo)
                                    <tr>
                                        <td>{{ $processo->nome }}</td>
                                        <td>{{ $processo->descricao }}</td>
                                        <td>{{ $processo->cliente->nome }}</td>
                                        <td>
                                            <a href="{{ route('processos.edit', $processo->id) }}" class="editbtn">Editar</a>
                                            <form action="{{ route('processos.destroy', $processo->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="deletebtn"
                                                    onclick="return confirm('Tem certeza que deseja excluir este processo?')">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Processos Recentes</h2>
                    </div>

                    @if ($processos->isEmpty())
                        <p class="no-data">Nenhum processo adicionado.</p>
                    @else
                        <table>
                            @foreach ($processos as $processo)
                                <tr>
                                    <td>
                                        <h4>{{ $processo->nome }} - Cliente:
                                            {{ $processo->cliente->nome }}
                                        </h4>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>

            <!-- =========== Scripts =========  -->
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

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                setTimeout(() => {
                    let alerts = document.querySelectorAll('.alert-dismissible');
                    alerts.forEach(alert => {
                        let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                        bsAlert.close();
                    });
                }, 5000);
            </script>
            <script>
                function confirmLogout() {
                    if (confirm('Tem certeza que deseja sair da conta?')) {
                        document.getElementById('logout-form').submit();
                    }
                }
            </script>

</body>

</html>