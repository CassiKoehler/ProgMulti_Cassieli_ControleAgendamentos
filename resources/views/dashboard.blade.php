@extends('layouts.app')

@section('content')
    <div class="bg-gray-800 rounded p-6 shadow-md max-w-2xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Seja bem vinda, {{ Auth::user()->name }}!</h2>
        <p>Use o menu à esquerda para navegar entre Clientes, Profissionais, Serviços e Agendamentos.</p>
    </div>
@endsection