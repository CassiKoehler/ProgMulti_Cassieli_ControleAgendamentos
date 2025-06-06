@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Agendamentos</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('agendamentos.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="cliente_id" class="block mb-1">Cliente:</label>
                    <select name="cliente_id" id="cliente_id" required
                        class="w-full px-3 py-2 border rounded bg-white text-black">
                        <option value="">Selecione um cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="profissional_id" class="block mb-1">Profissional:</label>
                    <select name="profissional_id" id="profissional_id" required
                        class="w-full px-3 py-2 border rounded bg-white text-black">
                        <option value="">Selecione um profissional</option>
                        @foreach($profissionais as $prof)
                            <option value="{{ $prof->id }}">{{ $prof->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="servico_id" class="block mb-1">Serviço:</label>
                    <select name="servico_id" id="servico_id" required
                        class="w-full px-3 py-2 border rounded bg-white text-black">
                        <option value="">Selecione um serviço</option>
                        @foreach($servicos as $servico)
                            <option value="{{ $servico->id }}">{{ $servico->nome_servico }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="data_hora" class="block mb-1">Data e Hora:</label>
                    <input type="datetime-local" name="data_hora" id="data_hora" required
                        class="w-full px-3 py-2 border rounded bg-white text-black" />
                </div>

                <div>
                    <label for="status" class="block mb-1">Status:</label>
                    <input type="text" name="status" id="status" placeholder="Pendente, Confirmado..."
                        class="w-full px-3 py-2 border rounded bg-white text-black" required />
                </div>

                <div class="sm:col-span-2">
                    <label for="observacao" class="block mb-1">Observação:</label>
                    <textarea name="observacao" id="observacao" rows="3"
                        class="w-full px-3 py-2 border rounded bg-white text-black"></textarea>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-accent hover:bg-accentHover text-white px-6 py-2 rounded font-semibold">
                    Cadastrar Agendamento
                </button>
            </div>
        </form>
    </div>

    <div class="max-w-6xl mx-auto bg-card text-textPrimary rounded shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Listagem de Agendamentos Registrados</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="px-4 py-2 border-b">Cliente</th>
                        <th class="px-4 py-2 border-b">Profissional</th>
                        <th class="px-4 py-2 border-b">Serviço</th>
                        <th class="px-4 py-2 border-b">Data/Hora</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendamentos as $agendamento)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $agendamento->cliente->nome }}</td>
                            <td class="px-4 py-2 border-b">{{ $agendamento->profissional->nome }}</td>
                            <td class="px-4 py-2 border-b">{{ $agendamento->servico->nome_servico }}</td>
                            <td class="px-4 py-2 border-b">
                                {{ \Carbon\Carbon::parse($agendamento->data_hora)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-2 border-b">{{ $agendamento->status }}</td>
                            <td class="px-4 py-2 border-b space-x-2">
                                <a href="{{ route('agendamentos.edit', $agendamento->id) }}"
                                    class="text-blue-500 hover:underline">Editar</a>
                                <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Deseja excluir este agendamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Excluir</button>
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
@endsection