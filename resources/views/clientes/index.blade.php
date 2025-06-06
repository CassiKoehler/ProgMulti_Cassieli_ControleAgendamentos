@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Cadastro de Clientes</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label for="nome" class="block mb-1">Nome:</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                        class="w-full px-3 py-2 border rounded bg-white text-black" required placeholder="Informe o nome">
                    @error('nome')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block mb-1">E-mail:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-3 py-2 border rounded bg-white text-black" required placeholder="Informe o e-mail">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="telefone" class="block mb-1">Telefone:</label>
                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                        class="w-full px-3 py-2 border rounded bg-white text-black" required
                        placeholder="Informe o telefone">
                    @error('telefone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-accent hover:bg-accentHover text-white px-6 py-2 rounded">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>

    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6">
        <form method="GET" action="{{ route('clientes.index') }}" class="mb-4 flex flex-col sm:flex-row gap-4">
            <input type="text" name="busca" placeholder="Pesquisar por nome, email ou telefone"
                value="{{ request('busca') }}" class="w-full px-3 py-2 border rounded bg-white text-black">
            <div class="pt-4">
                <button type="submit" class="bg-accent hover:bg-accentHover text-white px-6 py-2 rounded font-semibold">
                    Pesquisar
                </button>
            </div>
        </form>

        <h2 class="text-xl font-semibold mb-4">Listagem de Clientes Cadastrados</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary">
                        <th class="px-4 py-2 border-b">Nome</th>
                        <th class="px-4 py-2 border-b">E-mail</th>
                        <th class="px-4 py-2 border-b">Telefone</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $cliente->nome }}</td>
                            <td class="px-4 py-2 border-b">{{ $cliente->email }}</td>
                            <td class="px-4 py-2 border-b">{{ $cliente->telefone }}</td>
                            <td class="px-4 py-2 border-b space-x-2">
                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                    class="text-blue-500 hover:underline">Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center">Nenhum cliente encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection