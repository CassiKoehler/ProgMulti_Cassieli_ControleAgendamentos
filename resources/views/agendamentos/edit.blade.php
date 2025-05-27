@extends('layouts.app')

@section('content')
    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-6">Editar Agendamento</h1>

        <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST" class="w-full max-w-2xl bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="cliente_id" class="block text-sm font-medium">Cliente:</label>
                    <select name="cliente_id" id="cliente_id" class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $agendamento->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="profissional_id" class="block text-sm font-medium">Profissional:</label>
                    <select name="profissional_id" id="profissional_id" class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
                        @foreach($profissionais as $prof)
                            <option value="{{ $prof->id }}" {{ $agendamento->profissional_id == $prof->id ? 'selected' : '' }}>
                                {{ $prof->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="servico_id" class="block text-sm font-medium">Serviço:</label>
                    <select name="servico_id" id="servico_id" class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
                        @foreach($servicos as $servico)
                            <option value="{{ $servico->id }}" {{ $agendamento->servico_id == $servico->id ? 'selected' : '' }}>
                                {{ $servico->nome_servico }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="data_hora" class="block text-sm font-medium">Data e Hora:</label>
                    <input type="datetime-local" name="data_hora" id="data_hora"
                           value="{{ \Carbon\Carbon::parse($agendamento->data_hora)->format('Y-m-d\TH:i') }}"
                           class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium">Status:</label>
                    <input type="text" name="status" id="status" value="{{ $agendamento->status }}"
                           class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white" required>
                </div>

                <div class="sm:col-span-2">
                    <label for="observacao" class="block text-sm font-medium">Observação:</label>
                    <textarea name="observacao" id="observacao" rows="3"
                              class="w-full p-2 rounded border dark:bg-gray-800 dark:text-white">{{ $agendamento->observacao }}</textarea>
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('agendamentos.index') }}" class="text-blue-400 hover:underline">← Voltar</a>
                <button type="submit" class="py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
