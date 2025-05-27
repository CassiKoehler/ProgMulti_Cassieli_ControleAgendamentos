@extends('layouts.app')

@section('content')
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Editar Profissional</h1>

        <form action="{{ route('profissionais.update', $profissional->id) }}" method="POST"
              class="w-full max-w-md bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nome" class="block text-sm font-medium">Nome:</label>
                <input type="text" id="nome" name="nome" value="{{ $profissional->nome }}"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <div>
                <label for="especialidade" class="block text-sm font-medium">Especialidade:</label>
                <input type="text" id="especialidade" name="especialidade" value="{{ $profissional->especialidade }}"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('profissionais.index') }}" class="text-sm text-blue-400 hover:underline self-center">← Voltar</a>
                <button type="submit" class="py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
