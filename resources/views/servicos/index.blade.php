<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Cadastro de Serviços</h1>

        <!-- Formulário de Cadastro -->
        <form action="{{ route('servicos.store') }}" method="POST" class="w-full max-w-md bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label for="nome_servico" class="block text-sm font-medium">Nome do Serviço:</label>
                <input type="text" id="nome_servico" name="nome_servico" placeholder="Ex: Extensão de Cílios"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <div>
                <label for="descricao" class="block text-sm font-medium">Descrição:</label>
                <textarea id="descricao" name="descricao" placeholder="Detalhes sobre o serviço"
                          class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" rows="3"></textarea>
            </div>

            <div>
                <label for="preco" class="block text-sm font-medium">Preço (R$):</label>
                <input type="text" id="preco" name="preco" placeholder="Ex: 150.00"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold">
                Cadastrar Serviço
            </button>
        </form>

        <!-- Mensagem de sucesso -->
        @if(session('success'))
            <div class="mt-4 w-full max-w-md bg-green-500 text-white p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Lista de Serviços -->
        <div class="mt-10 w-full max-w-4xl">
            <h2 class="text-xl font-semibold mb-4">Serviços Cadastrados</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 rounded">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="py-2 px-4 text-left">Nome</th>
                            <th class="py-2 px-4 text-left">Descrição</th>
                            <th class="py-2 px-4 text-left">Preço</th>
                            <th class="py-2 px-4 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($servicos as $servico)
                            <tr class="border-t border-gray-700">
                                <td class="py-2 px-4">{{ $servico->nome_servico }}</td>
                                <td class="py-2 px-4">{{ $servico->descricao }}</td>
                                <td class="py-2 px-4">R$ {{ number_format($servico->preco, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 space-x-2">
                                    <a href="{{ route('servicos.edit', $servico->id) }}" class="text-blue-400 hover:underline">Editar</a>
                                    <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-400 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center">Nenhum serviço cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
