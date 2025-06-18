@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        Olá, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-gray-600">Aqui está um resumo do seu negócio hoje</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Clientes Ativos -->
            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-pink-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Clientes</p>
                        <p class="text-3xl font-bold text-gray-800" id="clientes-count">{{ $clientesAtivos ?? 0 }}</p>
                        <p class="text-xs text-green-600 mt-1">Ativos no sistema </p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a6 6 0 01-6 6M21 21H3">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Agendamentos Hoje -->
            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Agendamentos Hoje</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $agendamentosHoje ?? 0 }}</p>
                        <p class="text-xs text-blue-600 mt-1">{{ $proximoAgendamento ?? 'Agendamentos cadastrados' }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Profissionais -->
            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Profissionais</p>
                        <p id="profissionais-count" class="text-3xl font-bold text-gray-800 profissionais-count">
                            {{ $profissionais ?? 0 }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Ativos no sistema</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a6 6 0 01-6 6M21 21H3">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Receita do Mês -->
            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Faturamento do Mês</p>
                        <p class="text-3xl font-bold text-gray-800">R$ {{ number_format($receitaMes ?? 0, 2, ',', '.') }}
                        </p>
                        <p class="text-xs text-green-600 mt-1">↗ +8% vs mês anterior</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Ações Rápidas
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('clientes.index') }}"
                        class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3M12 3C6.477 3 2 7.477 2 12s4.477 9 9 9 9-4.477 9-9-4.477-9-9-9zm0 12l-3-3 1.5-1.5L12 12l3-3 1.5 1.5L12 15z">
                            </path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-800">Novo Cliente</p>
                            <p class="text-xs text-gray-600">Cadastrar cliente</p>
                        </div>
                    </a>

                    <a href="{{ route('agendamentos.index') }}"
                        class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200">
                        <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-800">Agendar</p>
                            <p class="text-xs text-gray-600">Novo agendamento</p>
                        </div>
                    </a>

                    <a href="{{ route('profissionais.index') }}"
                        class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                        <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-800">Profissionais</p>
                            <p class="text-xs text-gray-600">Gerenciar equipe</p>
                        </div>
                    </a>

                    <a href="{{ route('servicos.index') }}"
                        class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors duration-200">
                        <svg class="w-8 h-8 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-800">Serviços</p>
                            <p class="text-xs text-gray-600">Gerenciar serviços</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Services Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Serviços Mais Utilizados</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-20 text-sm text-gray-600">Técnica Volume 5D</div>
                        <div class="flex-1 mx-4">
                            <div class="bg-gray-200 rounded-full h-4">
                                <div class="bg-pink-500 h-4 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="text-sm font-semibold text-gray-800">85%</div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-20 text-sm text-gray-600">Técnica Volume 4D</div>
                        <div class="flex-1 mx-4">
                            <div class="bg-gray-200 rounded-full h-4">
                                <div class="bg-green-500 h-4 rounded-full" style="width: 72%"></div>
                            </div>
                        </div>
                        <div class="text-sm font-semibold text-gray-800">72%</div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-20 text-sm text-gray-600">Técnica Brasileiro Brown</div>
                        <div class="flex-1 mx-4">
                            <div class="bg-gray-200 rounded-full h-4">
                                <div class="bg-purple-500 h-4 rounded-full" style="width: 58%"></div>
                            </div>
                        </div>
                        <div class="text-sm font-semibold text-gray-800">58%</div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-20 text-sm text-gray-600">Técnica Brasileiro</div>
                        <div class="flex-1 mx-4">
                            <div class="bg-gray-200 rounded-full h-4">
                                <div class="bg-yellow-500 h-4 rounded-full" style="width: 43%"></div>
                            </div>
                        </div>
                        <div class="text-sm font-semibold text-gray-800">43%</div>
                    </div>
                </div>
            </div>
        </div>
@endsection

    @section('scripts')
        <script>
            // Função para atualizar os contadores via AJAX
            function atualizarContadores() {
                fetch('/dashboard/counts')
                    .then(response => response.json())
                    .then(data => {
                        // Atualiza o contador de clientes sem animação
                        const clientesCounter = document.getElementById('clientes-count');
                        if (clientesCounter) {
                            clientesCounter.textContent = data.clientesAtivos;
                        }

                        // Atualiza os outros contadores com animação simples
                        const profissionaisCounter = document.querySelector('[id$="-count"].profissionais-count');
                        if (profissionaisCounter) {
                            profissionaisCounter.textContent = data.profissionais;
                        }

                        const agendamentosCounter = document.querySelector('[id$="-count"].agendamentos-count');
                        if (agendamentosCounter) {
                            agendamentosCounter.textContent = data.agendamentosHoje;
                        }
                    })
                    .catch(error => console.error('Erro ao atualizar contadores:', error));
            }

            document.addEventListener('DOMContentLoaded', function () {
                // Atualiza os contadores inicialmente
                atualizarContadores();

                // Atualiza os contadores a cada 5 segundos
                setInterval(atualizarContadores, 5000);
            });
        </script>
    @endsection