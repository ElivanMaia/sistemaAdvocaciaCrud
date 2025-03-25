<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <a href="{{ route('advogados') }}">
                        <span class="icon">
                        <img src="{{ asset('assets/imgs/successProcess.png') }}" alt="Logo" width="32" height="32">
                        </span>
                        <span class="title">Advogados</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('processos') }}">
                        <span class="icon">
                        <img src="{{ asset('assets/imgs/successProcess.png') }}" alt="Logo" width="32" height="32">
                        </span>
                        <span class="title">Processos</span>
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

            <!-- ================ Order Details List ================= -->
            <div class="container">
        <h2>Métricas de Desempenho</h2>
        <canvas id="metricsChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Dados dinâmicos (você pode substituí-los pelos valores reais do backend)
        const clientesCount = {{ $clientesCount }};
        const advogadosCount = {{ $advogadosCount }};
        const agendamentosCount = {{ $agendamentosCount }};
        const lucro = {{ $lucro }};

        // Configuração do Gráfico
        const ctx = document.getElementById('metricsChart').getContext('2d');
        const metricsChart = new Chart(ctx, {
            type: 'bar', // Tipo do gráfico
            data: {
                labels: ['Clientes', 'Advogados', 'Agendamentos', 'Lucro (em milhares)'], // Nomes das categorias
                datasets: [{
                    label: 'Métricas',
                    data: [clientesCount, advogadosCount, agendamentosCount, lucro / 1000], // Valores
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)', // Azul para Clientes
                        'rgba(153, 102, 255, 0.5)', // Roxo para Advogados
                        'rgba(255, 159, 64, 0.5)', // Laranja para Agendamentos
                        'rgba(255, 99, 132, 0.5)'  // Vermelho para Lucro
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Posição da legenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                if (context.label === 'Lucro (em milhares)') {
                                    return `Lucro: R$ ${(context.raw * 1000).toLocaleString('pt-BR')}`;
                                }
                                return `${context.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Valores'
                        }
                    }
                }
            }
        });
    </script>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
