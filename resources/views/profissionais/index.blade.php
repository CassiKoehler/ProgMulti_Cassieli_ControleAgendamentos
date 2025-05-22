<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Cadastro de Profissionais</h1>

        <!-- Formulário de Cadastro -->
        <form action="{{ route('profissionais.store') }}" method="POST" class="w-full max-w-md bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label for="nome" class="block text-sm font-medium">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do profissional"
                       class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
            </div>

            <div>
                <label for="especialidade" class="block text-sm font-medium">Especialidade:</label>
                <input type="text" id="especialidade" name="especialidade" placeholder="Ex: Extensão de cílios, Designer"
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

        <!-- Lista de Profissionais -->
        <div class="mt-10 w-full max-w-4xl">
            <h2 class="text-xl font-semibold mb-4">Profissionais Cadastrados</h2>
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
                                    <a href="{{ route('profissionais.edit', $profissional->id) }}" class="text-blue-400 hover:underline">Editar</a>
                                    <form action="{{ route('profissionais.destroy', $profissional->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-400 hover:underline">Excluir</button>
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
</x-app-layout>
