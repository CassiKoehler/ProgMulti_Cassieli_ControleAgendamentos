<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Agendamentos</h1>

        <!-- Formulário de Agendamento -->
        <form action="{{ route('agendamentos.store') }}" method="POST" class="w-full max-w-2xl bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="cliente_id" class="block text-sm font-medium">Cliente:</label>
                    <select name="cliente_id" id="cliente_id" class="w-full p-2 rounded border bg-pink-500 text-white" required>
                        <option value="">Selecione um cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="profissional_id" class="block text-sm font-medium">Profissional:</label>
                    <select name="profissional_id" id="profissional_id" class="w-full p-2 rounded border bg-pink-500 text-white" required>
                        <option value="">Selecione um profissional</option>
                        @foreach($profissionais as $prof)
                            <option value="{{ $prof->id }}">{{ $prof->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="servico_id" class="block text-sm font-medium">Serviço:</label>
                    <select name="servico_id" id="servico_id" class="w-full p-2 rounded border bg-pink-500 text-white" required>
                        <option value="">Selecione um serviço</option>
                        @foreach($servicos as $servico)
                            <option value="{{ $servico->id }}">{{ $servico->nome_servico }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="data_hora" class="block text-sm font-medium">Data e Hora:</label>
                    <input type="datetime-local" name="data_hora" id="data_hora"
                           class="w-full p-2 rounded border text-white focus:outline-none"
                           style="background-color: #ec4899;" required>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium">Status:</label>
                    <input type="text" name="status" id="status" placeholder="Pendente, Confirmado..."
                           class="w-full p-2 rounded border text-white focus:outline-none"
                           style="background-color: #ec4899;" required>
                </div>

                <div class="sm:col-span-2">
                    <label for="observacao" class="block text-sm font-medium">Observação:</label>
                    <textarea name="observacao" id="observacao" rows="3"
                              class="w-full p-2 rounded border text-white focus:outline-none"
                              style="background-color: #ec4899;"></textarea>
                </div>
            </div>

            <button type="submit" class="w-full mt-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold">
                Cadastrar Agendamento
            </button>
        </form>

        <!-- Mensagem -->
        @if(session('success'))
            <div class="mt-4 w-full max-w-2xl bg-green-500 text-white p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Lista de Agendamentos -->
        <div class="mt-10 w-full max-w-5xl">
            <h2 class="text-xl font-semibold mb-4">Agendamentos Registrados</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 rounded">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="py-2 px-4">Cliente</th>
                            <th class="py-2 px-4">Profissional</th>
                            <th class="py-2 px-4">Serviço</th>
                            <th class="py-2 px-4">Data/Hora</th>
                            <th class="py-2 px-4">Status</th>
                            <th class="py-2 px-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($agendamentos as $agendamento)
                            <tr class="border-t border-gray-700">
                                <td class="py-2 px-4">{{ $agendamento->cliente->nome }}</td>
                                <td class="py-2 px-4">{{ $agendamento->profissional->nome }}</td>
                                <td class="py-2 px-4">{{ $agendamento->servico->nome_servico }}</td>
                                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($agendamento->data_hora)->format('d/m/Y H:i') }}</td>
                                <td class="py-2 px-4">{{ $agendamento->status }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('agendamentos.edit', $agendamento->id) }}" class="text-blue-400 hover:underline">Editar</a>
                                    <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Deseja excluir este agendamento?')" class="text-red-400 hover:underline">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Nenhum agendamento registrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
