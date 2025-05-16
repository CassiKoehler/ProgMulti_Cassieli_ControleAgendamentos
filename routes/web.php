<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

###Criando a Rota de Cliente
use App\Http\Controllers\ClienteController;
Route::resource('clientes', ClienteController::class);
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::resource('clientes', ClienteController::class);

###Criando a Rota de Profissional
use App\Http\Controllers\ProfissionalController;
Route::resource('profissionais', ProfissionalController::class);

###Criando a Rota de Serviços
use App\Http\Controllers\ServicoController;
Route::resource('servicos', ServicoController::class);

###Criando a Rota de Agendamentos
use App\Http\Controllers\AgendamentoController;
Route::resource('agendamentos', AgendamentoController::class);


require __DIR__.'/auth.php';

#######

