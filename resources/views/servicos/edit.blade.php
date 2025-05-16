<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Editar Serviço</h1>

        <form action="{{ route('servicos.update', $servico->id) }}" method="POST"
              class="w-full max-w-md bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nome_servico" class="block text-sm font-medium">Nome do Serviço:</label>
                <input type="text" id="nome_servico" name="nome_servico" value="{{ $servico->nome_servico }}"
                       class="w-full p-2 rounded border text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-pink-300"
                       style="background-color: #ec4899;" required>
            </div>

            <div>
                <label for="descricao" class="block text-sm font-medium">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="3"
                          class="w-full p-2 rounded border text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-pink-300"
                          style="background-color: #ec4899;">{{ $servico->descricao }}</textarea>
            </div>

            <div>
                <label for="preco" class="block text-sm font-medium">Preço (R$):</label>
                <input type="text" id="preco" name="preco" value="{{ $servico->preco }}"
                       class="w-full p-2 rounded border text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-pink-300"
                       style="background-color: #ec4899;" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('servicos.index') }}"
                   class="text-sm text-blue-400 hover:underline self-center">← Voltar</a>

                <button type="submit"
                        class="py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
