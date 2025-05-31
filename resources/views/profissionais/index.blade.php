@extends('layouts.app')

@section('content')
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Cadastro de Profissionais</h1>

        <!-- Formulário de Cadastro -->
        <form action="{{ route('profissionais.store') }}" method="POST"
            class="w-full max-w-md bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label for="nome" class="block text-sm font-medium">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do profissional"
                    value="{{ old('nome') }}"
                    class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white @error('nome') border-red-500 @enderror"
                    required>
                @error('nome')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="especialidade" class="block text-sm font-medium">Especialidade:</label>
                <input type="text" id="especialidade" name="especialidade" placeholder="Ex: Extensão de cílios, Designer"
                    value="{{ old('especialidade') }}"
                    class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white @error('especialidade') border-red-500 @enderror"
                    required>
                @error('especialidade')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold">
                Cadastrar
            </button>
        </form>

        <!-- Mensagens de Sucesso -->
        @if(session('success'))
            <div class="mt-4 w-full max-w-md bg-green-500 text-white p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mensagens de Erro -->
        @if($errors->any())
            <div class="mt-4 w-full max-w-md bg-red-600 text-white p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de Pesquisa -->
        <form method="GET" action="{{ route('profissionais.index') }}" class="mt-8 mb-4 max-w-md w-full">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar por nome"
                class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" />
            <button type="submit" class="mt-2 w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold">
                Pesquisar
            </button>
        </form>

        <!-- Lista de Profissionais -->
        <div class="mt-6 w-full max-w-4xl">
            <h2 class="text-xl font-semibold mb-4">Listagem de Profissionais Cadastrados</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 rounded">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="py-2 px-4 text-left">Nome</th>
                            <th class="py-2 px-4 text-left">Especialidade</th>
                            <th class="py-2 px-4 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($profissionais as $profissional)
                            <tr class="border-t border-gray-700">
                                <td class="py-2 px-4">{{ $profissional->nome }}</td>
                                <td class="py-2 px-4">{{ $profissional->especialidade }}</td>
                                <td class="py-2 px-4 space-x-2">
                                    <a href="{{ route('profissionais.edit', $profissional->id) }}"
                                        class="text-blue-400 hover:underline">Editar</a>

                                    <form action="{{ route('profissionais.destroy', $profissional->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')"
                                            class="text-red-400 hover:underline">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-4 text-center">Nenhum profissional cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection