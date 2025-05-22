<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Cadastro de Clientes</h1>

        <!-- Formulário de Cadastro -->
        <form action="{{ route('clientes.store') }}" method="POST" class="w-full max-w-md bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label for="nome" class="block text-sm font-medium">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome completo"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email:</label>
                <input type="email" id="email" name="email" placeholder="email@exemplo.com"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <div>
                <label for="telefone" class="block text-sm font-medium">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="(99) 99999-9999"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold">
                Cadastrar
            </button>
        </form>

        <!-- Mensagem de Sucesso -->
        @if(session('success'))
            <div class="mt-4 w-full max-w-md bg-green-500 text-white p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Lista de Clientes -->
        <div class="mt-10 w-full max-w-4xl">
            <h2 class="text-xl font-semibold mb-4">Clientes Cadastrados</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 rounded">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="py-2 px-4 text-left">Nome</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Telefone</th>
                            <th class="py-2 px-4 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($clientes as $cliente)
                            <tr class="border-t border-gray-700">
                                <td class="py-2 px-4">{{ $cliente->nome }}</td>
                                <td class="py-2 px-4">{{ $cliente->email }}</td>
                                <td class="py-2 px-4">{{ $cliente->telefone }}</td>
                                <td class="py-2 px-4 space-x-2">
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-blue-400 hover:underline">Editar</a>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-400 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center">Nenhum cliente cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
