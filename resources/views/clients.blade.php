<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv+u5O1/21t9b/aK4L5e+zg5n52ZZkY94kdDmg1VV5zz00Ch2BStQKpfFJs" crossorigin="anonymous">

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
                        <img src="{{ asset('assets/imgs/calendar.png') }}" alt="Logo" width="32" height="32">
                        </span>
                        <span class="title">Agendamentos</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('processos') }}">
                        <span class="icon">
                        <img src="{{ asset('assets/imgs/process.png') }}" alt="Logo" width="32" height="32">
                        </span>
                        <span class="title">Processos</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('advogados') }}">
                        <span class="icon">
                        <img src="{{ asset('assets/imgs/successProcess.png') }}" alt="Logo" width="32" height="32">
                        </span>
                        <span class="title">Advogados</span>
                    </a>
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
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="user">
                    <a href="{{ route('profile.edit') }}">
                    <img src="{{ asset('assets/imgs/userIcon.png') }}" alt="">
                </a>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">N. de Clientes</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Sales</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">$7,842</div>
                        <div class="cardName">Earning</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Dados dos Clientes</h2>
                        <a href="{{ route('clients.create') }}" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Email</td>
                                <td>Telefone</td>
                                <td>CPF</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td> {{ $cliente->nome }} </td>
                                <td> {{ $cliente->email }} </td>
                                <td> {{ $cliente->telefone }} </td>
                                <td> {{ $cliente->cpf }} </td>
                                <td> {{ $cliente->data_nasc }} </td>
                                <td>
                                <a href="{{ route('clients.edit', ['cliente' => $cliente->id]) }}">Editar</a>
                                <form action="{{ route('clients.destroy', ['cliente' => $cliente->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                                </form>
                                </td>                         
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Clientes Recentes</h2>
                    </div>
                    <table>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>
                                <h4>{{ $cliente->nome}}<br> <span>Novo</span></h4>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>
