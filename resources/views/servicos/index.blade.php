@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Cadastro de Serviços</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('servicos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nome_servico" class="block mb-1">Nome do Serviço:</label>
                <input type="text" id="nome_servico" name="nome_servico" placeholder="Ex: Extensão de Cílios"
                    class="w-full px-3 py-2 border rounded bg-white text-black" required>
            </div>

            <div>
                <label for="descricao" class="block mb-1">Descrição:</label>
                <textarea id="descricao" name="descricao" placeholder="Detalhes sobre o serviço"
                    class="w-full px-3 py-2 border rounded bg-white text-black" rows="3"></textarea>
            </div>

            <div>
                <label for="preco" class="block mb-1">Preço (R$):</label>
                <input type="text" id="preco" name="preco" placeholder="Ex: 150.00"
                    class="w-full px-3 py-2 border rounded bg-white text-black" required>
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-accent hover:bg-accentHover text-white px-6 py-2 rounded font-semibold">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>

    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6">
        <form method="GET" action="{{ route('servicos.index') }}" class="mb-4 flex flex-col sm:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar por Nome do Serviço"
                class="w-full px-3 py-2 border rounded bg-white text-black" />
            <div class="pt-4">
                <button type="submit" class="bg-accent hover:bg-accentHover text-white px-6 py-2 rounded font-semibold">
                    Pesquisar
                </button>
            </div>
        </form>

        <h2 class="text-xl font-semibold mb-4">Listagem de Serviços Cadastrados</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary">
                        <th class="px-4 py-2 border-b">Nome</th>
                        <th class="px-4 py-2 border-b">Descrição</th>
                        <th class="px-4 py-2 border-b">Preço</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicos as $servico)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $servico->nome_servico }}</td>
                            <td class="px-4 py-2 border-b">{{ $servico->descricao }}</td>
                            <td class="px-4 py-2 border-b">R$ {{ number_format($servico->preco, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b space-x-2">
                                <a href="{{ route('servicos.edit', $servico->id) }}"
                                    class="text-blue-500 hover:underline">Editar</a>

                                <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center">Nenhum serviço cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection