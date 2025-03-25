<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cliente;
use App\Models\Advogado;
use App\Models\Agendamento;
use App\Models\Processo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $clientesCount = Cliente::count();
            $advogadosCount = Advogado::count();
            $agendamentosCount = Agendamento::count();
            $processosCount = Processo::count();
            $lucro = $clientesCount * 2397;

            $view->with([
                'clientesCount' => $clientesCount,
                'advogadosCount' => $advogadosCount,
                'agendamentosCount' => $agendamentosCount,
                'processosCount' => $processosCount,
                'lucro' => $lucro,
            ]);
        });
    }

    public function register(): void
    {
        //
    }
}
