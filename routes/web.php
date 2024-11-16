<?php

use App\Http\Controllers\AdvogadosController;
use App\Http\Controllers\AgendamentosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProcessosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/advogados', function () {
    return view('advogados');
})->middleware(['auth', 'verified'])->name('advogados');

Route::get('/agendamentos', function () {
    return view('agendamentos');
})->middleware(['auth', 'verified'])->name('agendamentos');

Route::get('/processos', function () {
    return view('processos');
})->middleware(['auth', 'verified'])->name('processos');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clients');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clients.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clients.store');  
    Route::post('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clients.show');  
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clients.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clients.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clients.destroy'); 
});



require __DIR__.'/auth.php';
