@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Cadastro de Profissionais</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profissionais.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nome" class="block mb-1">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do profissional"
                    value="{{ old('nome') }}"
                    class="w-full px-3 py-2 border rounded bg-white text-black @error('nome') border-red-500 @enderror"
                    required>
                @error('nome')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="especialidade" class="block mb-1">Especialidade:</label>
                <input type="text" id="especialidade" name="especialidade" placeholder="Ex: Extensão de cílios, Designer"
                    value="{{ old('especialidade') }}"
                    class="w-full px-3 py-2 border rounded bg-white text-black @error('especialidade') border-red-500 @enderror"
                    required>
                @error('especialidade')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-accent hover:bg-accentHover text-white px-6 py-2 rounded font-semibold">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>

    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6">
        <form method="GET" action="{{ route('profissionais.index') }}" class="mb-4 flex flex-col sm:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar por nome"
                class="w-full px-3 py-2 border rounded bg-white text-black" />

            <div class="pt-4">
                <button type="submit" class="bg-accent hover:bg-accentHover text-white px-6 py-2 rounded font-semibold">
                    Pesquisar
                </button>
            </div>
        </form>

        <h2 class="text-xl font-semibold mb-4">Listagem de Profissionais Cadastrados</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary">
                        <th class="px-4 py-2 border-b">Nome</th>
                        <th class="px-4 py-2 border-b">Especialidade</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profissionais as $profissional)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $profissional->nome }}</td>
                            <td class="px-4 py-2 border-b">{{ $profissional->especialidade }}</td>
                            <td class="px-4 py-2 border-b space-x-2">
                                <a href="{{ route('profissionais.edit', $profissional->id) }}"
                                    class="text-blue-500 hover:underline">Editar</a>

                                <form action="{{ route('profissionais.destroy', $profissional->id) }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este profissional?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center">Nenhum profissional cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection