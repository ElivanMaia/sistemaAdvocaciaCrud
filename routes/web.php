<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard2', function () {
    return view('dashboard2');
})->middleware(['auth', 'verified'])->name('dashboard2');

Route::get('/clients', function () {
    return view('clients');
})->middleware(['auth', 'verified'])->name('clients');

Route::get('/agendamentos', function () {
    return view('agendamentos');
})->middleware(['auth', 'verified'])->name('agendamentos');

Route::get('/processos', function () {
    return view('processos');
})->middleware(['auth', 'verified'])->name('processos');

Route::get('/processosBS', function () {
    return view('processosBS');
})->middleware(['auth', 'verified'])->name('processosBS');

Route::get('/processosPend', function () {
    return view('processosPend');
})->middleware(['auth', 'verified'])->name('processosPend');

Route::get('/processosFal', function () {
    return view('processosFal');
})->middleware(['auth', 'verified'])->name('processosFal');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
