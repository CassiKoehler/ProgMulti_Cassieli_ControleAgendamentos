@extends('layouts.app')

@section('content')
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h1 class="text-2xl font-bold mb-4">Editar Cliente</h1>

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nome" class="block">Nome:</label>
                <input type="text" id="nome" name="nome" value="{{ $cliente->nome }}"
                    class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label for="email" class="block">Email:</label>
                <input type="email" id="email" name="email" value="{{ $cliente->email }}"
                    class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label for="telefone" class="block">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="{{ $cliente->telefone }}"
                    class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white">
            </div>

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Salvar Alterações</button>
        </form>
    </div>
@endsection
