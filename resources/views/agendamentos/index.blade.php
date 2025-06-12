@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-slate-800 mb-2">Gestão de Agendamentos</h1>
                <p class="text-slate-600">Organize e gerencie todos os seus agendamentos de forma eficiente</p>
            </div>
        </div>

        @if(session('success'))
            <div class="max-w-7xl mx-auto mb-6">
                <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Card de Novo Agendamento -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Novo Agendamento</h2>
                            <p class="text-blue-100">Preencha os dados do agendamento</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('agendamentos.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="cliente_id" class="block text-sm font-semibold text-slate-700">Cliente *</label>
                                <select name="cliente_id" id="cliente_id" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="profissional_id" class="block text-sm font-semibold text-slate-700">Profissional *</label>
                                <select name="profissional_id" id="profissional_id" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione um profissional</option>
                                    @foreach($profissionais as $prof)
                                        <option value="{{ $prof->id }}">{{ $prof->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="servico_id" class="block text-sm font-semibold text-slate-700">Serviço *</label>
                                <select name="servico_id" id="servico_id" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione um serviço</option>
                                    @foreach($servicos as $servico)
                                        <option value="{{ $servico->id }}">{{ $servico->nome_servico }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="data_hora" class="block text-sm font-semibold text-slate-700">Data e Hora *</label>
                                <input type="datetime-local" name="data_hora" id="data_hora" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                            </div>

                            <div class="space-y-2">
                                <label for="status" class="block text-sm font-semibold text-slate-700">Status *</label>
                                <select name="status" id="status" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione o status</option>
                                    <option value="Pendente">Pendente</option>
                                    <option value="Confirmado">Confirmado</option>
                                    <option value="Em Andamento">Em Andamento</option>
                                    <option value="Concluído">Concluído</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>

                            <div class="space-y-2 md:col-span-2 lg:col-span-1">
                                <label for="observacao" class="block text-sm font-semibold text-slate-700">Observação</label>
                                <textarea name="observacao" id="observacao" rows="3" placeholder="Observações adicionais..."
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"></textarea>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-200">
                            <button type="submit" 
                                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Cadastrar Agendamento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card de Listagem -->
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-3 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Agendamentos Cadastrados</h2>
                                <p class="text-slate-300">Gerencie e visualize todos os agendamentos</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-white">{{ count($agendamentos) }}</div>
                            <div class="text-slate-300 text-sm">Total</div>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    @if(count($agendamentos) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-slate-200">
                                        <th class="text-left py-4 px-4 font-semibold text-slate-700">Cliente</th>
                                        <th class="text-left py-4 px-4 font-semibold text-slate-700">Profissional</th>
                                        <th class="text-left py-4 px-4 font-semibold text-slate-700">Serviço</th>
                                        <th class="text-left py-4 px-4 font-semibold text-slate-700">Data/Hora</th>
                                        <th class="text-left py-4 px-4 font-semibold text-slate-700">Status</th>
                                        <th class="text-center py-4 px-4 font-semibold text-slate-700">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agendamentos as $agendamento)
                                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                                            <td class="py-4 px-4">
                                                <div class="font-semibold text-slate-800">{{ $agendamento->cliente->nome }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-slate-700">{{ $agendamento->profissional->nome }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-slate-700">{{ $agendamento->servico->nome_servico }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-slate-700">
                                                    {{ \Carbon\Carbon::parse($agendamento->data_hora)->format('d/m/Y') }}
                                                </div>
                                                <div class="text-sm text-slate-500">
                                                    {{ \Carbon\Carbon::parse($agendamento->data_hora)->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                @php
                                                    $statusColors = [
                                                        'Pendente' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                        'Confirmado' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                        'Em Andamento' => 'bg-orange-100 text-orange-800 border-orange-200',
                                                        'Concluído' => 'bg-green-100 text-green-800 border-green-200',
                                                        'Cancelado' => 'bg-red-100 text-red-800 border-red-200'
                                                    ];
                                                    $colorClass = $statusColors[$agendamento->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                                @endphp
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $colorClass }}">
                                                    {{ $agendamento->status }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('agendamentos.edit', $agendamento->id) }}" 
                                                        class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors duration-200" 
                                                        title="Editar">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST"
                                                        class="inline" onsubmit="return confirm('Deseja excluir este agendamento?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-colors duration-200" 
                                                            title="Excluir">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="bg-slate-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-slate-700 mb-2">Nenhum agendamento encontrado</h3>
                            <p class="text-slate-500">Cadastre seu primeiro agendamento usando o formulário acima.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection