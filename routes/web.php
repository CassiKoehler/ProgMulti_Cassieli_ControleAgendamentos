<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recursos protegidos por login
    Route::resource('clientes', ClienteController::class);
    Route::resource('profissionais', ProfissionalController::class);
    Route::resource('servicos', ServicoController::class);
    Route::resource('agendamentos', AgendamentoController::class);

    #######

    Route::get('/painel-agendamentos', [AgendamentoController::class, 'painel'])->name('agendamentos.painel');
    Route::get('/agendamentos/eventos', [AgendamentoController::class, 'eventos']);


});

require __DIR__ . '/auth.php';
