@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-slate-800 mb-2">Editar Agendamento</h1>
                <p class="text-slate-600">Atualize as informações do agendamento</p>
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

        @if($errors->any())
            <div class="max-w-7xl mx-auto mb-6">
                <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl shadow-sm">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold">Erro nos dados informados:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Card de Edição -->
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-purple-600 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Editar Agendamento</h2>
                            <p class="text-orange-100">Atualize as informações do agendamento</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label for="cliente_id" class="block text-sm font-semibold text-slate-700">Cliente *</label>
                                <select name="cliente_id" id="cliente_id" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ $agendamento->cliente_id == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="profissional_id" class="block text-sm font-semibold text-slate-700">Profissional *</label>
                                <select name="profissional_id" id="profissional_id" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione um profissional</option>
                                    @foreach($profissionais as $prof)
                                        <option value="{{ $prof->id }}" {{ $agendamento->profissional_id == $prof->id ? 'selected' : '' }}>
                                            {{ $prof->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="servico_id" class="block text-sm font-semibold text-slate-700">Serviço *</label>
                                <select name="servico_id" id="servico_id" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione um serviço</option>
                                    @foreach($servicos as $servico)
                                        <option value="{{ $servico->id }}" {{ $agendamento->servico_id == $servico->id ? 'selected' : '' }}>
                                            {{ $servico->nome_servico }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="data_hora" class="block text-sm font-semibold text-slate-700">Data e Hora *</label>
                                <input type="datetime-local" name="data_hora" id="data_hora" required
                                    value="{{ \Carbon\Carbon::parse($agendamento->data_hora)->format('Y-m-d\TH:i') }}"
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" />
                            </div>

                            <div class="space-y-2">
                                <label for="status" class="block text-sm font-semibold text-slate-700">Status *</label>
                                <select name="status" id="status" required
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Selecione o status</option>
                                    <option value="Pendente" {{ $agendamento->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="Confirmado" {{ $agendamento->status == 'Confirmado' ? 'selected' : '' }}>Confirmado</option>
                                    <option value="Em Andamento" {{ $agendamento->status == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="Concluído" {{ $agendamento->status == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                                    <option value="Cancelado" {{ $agendamento->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </div>

                            <div class="space-y-2 md:col-span-2 lg:col-span-1">
                                <label for="observacao" class="block text-sm font-semibold text-slate-700">Observação</label>
                                <textarea name="observacao" id="observacao" rows="3" placeholder="Observações adicionais..."
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl bg-white text-slate-900 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none">{{ $agendamento->observacao }}</textarea>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                            <a href="{{ route('agendamentos.index') }}" 
                                class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Voltar
                            </a>
                            
                            <button type="submit" 
                                class="bg-gradient-to-r from-purple-600 to-purple-600 hover:from-purple-700 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection