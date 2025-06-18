@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header com título e controles -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Painel de Agendamentos</h1>
                    <p class="text-purple-100">Gerencie seus agendamentos de forma visual e intuitiva</p>
                </div>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <button id="btn-hoje" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-all duration-200 backdrop-blur-sm">
                        <i class="fas fa-calendar-day mr-2"></i>Hoje
                    </button>
                    <a href="{{ route('agendamentos.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-all duration-200 backdrop-blur-sm">
                        <i class="fas fa-plus mr-2"></i>Novo Agendamento
                    </a>
                </div>
            </div>
        </div>

        <!-- Estatísticas rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar text-blue-600"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-600">Hoje</p>
                        <p class="text-lg font-semibold text-gray-900" id="agendamentos-hoje">0</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-600">Confirmados</p>
                        <p class="text-lg font-semibold text-gray-900" id="agendamentos-confirmados">0</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-600">Pendentes</p>
                        <p class="text-lg font-semibold text-gray-900" id="agendamentos-pendentes">0</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-purple-600"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-600">Esta Semana</p>
                        <p class="text-lg font-semibold text-gray-900" id="agendamentos-semana">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendário -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Calendário de Agendamentos</h2>
                    <div class="flex items-center space-x-2 mt-2 md:mt-0">
                        <div class="flex items-center space-x-4 text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span>Confirmado</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                <span>Pendente</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                <span>Cancelado</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                <span>Outros</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="calendar"></div>
            </div>
        </div>

        <!-- Próximos agendamentos -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Próximos Agendamentos</h2>
            <div id="proximos-agendamentos" class="space-y-3">
                <!-- Será preenchido via JavaScript -->
            </div>
        </div>
    </div>

    <!-- Modal para detalhes do agendamento -->
    <div id="modal-agendamento" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Detalhes do Agendamento</h3>
                        <button id="fechar-modal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div id="conteudo-modal" class="space-y-3">
                        <!-- Conteúdo será preenchido via JavaScript -->
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button id="btn-editar" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-edit mr-2"></i>Editar
                        </button>
                        <button id="fechar-modal-btn" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS do FullCalendar -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet' />

    <!-- JS do FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales-all.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            let calendar;

            // Inicializar calendário
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'pt-br',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'Lista'
                },
                events: '/agendamentos/eventos',
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5, 6],
                    startTime: '08:00',
                    endTime: '18:00',
                },
                eventClick: function(info) {
                    mostrarDetalhesAgendamento(info.event);
                },
                eventDidMount: function(info) {
                    // Adicionar tooltip
                    info.el.title = `${info.event.title}\nStatus: ${info.event.extendedProps.status}`;
                },
                loading: function(bool) {
                    if (bool) {
                        document.body.style.cursor = 'wait';
                    } else {
                        document.body.style.cursor = 'default';
                        atualizarEstatisticas();
                        carregarProximosAgendamentos();
                    }
                }
            });

            calendar.render();

            // Event listeners
            document.getElementById('btn-hoje').addEventListener('click', function() {
                calendar.today();
            });

            document.getElementById('fechar-modal').addEventListener('click', fecharModal);
            document.getElementById('fechar-modal-btn').addEventListener('click', fecharModal);

            // Carregar dados iniciais
            setTimeout(() => {
                atualizarEstatisticas();
                carregarProximosAgendamentos();
            }, 1000);

            function mostrarDetalhesAgendamento(event) {
                const modal = document.getElementById('modal-agendamento');
                const conteudo = document.getElementById('conteudo-modal');
                const btnEditar = document.getElementById('btn-editar');

                const dataFormatada = new Date(event.start).toLocaleDateString('pt-BR', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                conteudo.innerHTML = `
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-user w-5 text-gray-500 mr-3"></i>
                            <span class="text-sm text-gray-600">Cliente:</span>
                            <span class="ml-2 font-medium">${event.extendedProps.cliente}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-tie w-5 text-gray-500 mr-3"></i>
                            <span class="text-sm text-gray-600">Profissional:</span>
                            <span class="ml-2 font-medium">${event.extendedProps.profissional || 'N/A'}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-scissors w-5 text-gray-500 mr-3"></i>
                            <span class="text-sm text-gray-600">Serviço:</span>
                            <span class="ml-2 font-medium">${event.extendedProps.servico}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt w-5 text-gray-500 mr-3"></i>
                            <span class="text-sm text-gray-600">Data/Hora:</span>
                            <span class="ml-2 font-medium">${dataFormatada}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-info-circle w-5 text-gray-500 mr-3"></i>
                            <span class="text-sm text-gray-600">Status:</span>
                            <span class="ml-2 font-medium px-2 py-1 rounded-full text-xs ${getStatusClass(event.extendedProps.status)}">${event.extendedProps.status}</span>
                        </div>
                        ${event.extendedProps.observacao ? `
                        <div class="flex items-start">
                            <i class="fas fa-sticky-note w-5 text-gray-500 mr-3 mt-1"></i>
                            <span class="text-sm text-gray-600">Observação:</span>
                            <span class="ml-2 text-sm">${event.extendedProps.observacao}</span>
                        </div>
                        ` : ''}
                    </div>
                `;

                btnEditar.onclick = function() {
                    window.location.href = `/agendamentos/${event.id}/edit`;
                };

                modal.classList.remove('hidden');
            }

            function fecharModal() {
                document.getElementById('modal-agendamento').classList.add('hidden');
            }

            function getStatusClass(status) {
                const classes = {
                    'confirmado': 'bg-green-100 text-green-800',
                    'pendente': 'bg-yellow-100 text-yellow-800',
                    'cancelado': 'bg-red-100 text-red-800'
                };
                return classes[status.toLowerCase()] || 'bg-blue-100 text-blue-800';
            }

            function atualizarEstatisticas() {
                fetch('/agendamentos/eventos')
                    .then(response => response.json())
                    .then(data => {
                        const hoje = new Date().toDateString();
                        const inicioSemana = new Date();
                        inicioSemana.setDate(inicioSemana.getDate() - inicioSemana.getDay());
                        const fimSemana = new Date(inicioSemana);
                        fimSemana.setDate(fimSemana.getDate() + 6);

                        const agendamentosHoje = data.filter(event => 
                            new Date(event.start).toDateString() === hoje
                        ).length;

                        const agendamentosConfirmados = data.filter(event => 
                            event.extendedProps && event.extendedProps.status === 'confirmado'
                        ).length;

                        const agendamentosPendentes = data.filter(event => 
                            event.extendedProps && event.extendedProps.status === 'pendente'
                        ).length;

                        const agendamentosSemana = data.filter(event => {
                            const eventDate = new Date(event.start);
                            return eventDate >= inicioSemana && eventDate <= fimSemana;
                        }).length;

                        document.getElementById('agendamentos-hoje').textContent = agendamentosHoje;
                        document.getElementById('agendamentos-confirmados').textContent = agendamentosConfirmados;
                        document.getElementById('agendamentos-pendentes').textContent = agendamentosPendentes;
                        document.getElementById('agendamentos-semana').textContent = agendamentosSemana;
                    })
                    .catch(error => console.error('Erro ao carregar estatísticas:', error));
            }

            function carregarProximosAgendamentos() {
                fetch('/agendamentos/eventos')
                    .then(response => response.json())
                    .then(data => {
                        const agora = new Date();
                        const proximosAgendamentos = data
                            .filter(event => new Date(event.start) >= agora)
                            .sort((a, b) => new Date(a.start) - new Date(b.start))
                            .slice(0, 5);

                        const container = document.getElementById('proximos-agendamentos');
                        
                        if (proximosAgendamentos.length === 0) {
                            container.innerHTML = '<p class="text-gray-500 text-center py-4">Nenhum agendamento próximo encontrado.</p>';
                            return;
                        }

                        container.innerHTML = proximosAgendamentos.map(event => {
                            const dataHora = new Date(event.start).toLocaleString('pt-BR', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            return `
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer" onclick="mostrarDetalhesAgendamento({
                                    id: '${event.id}',
                                    title: '${event.title}',
                                    start: '${event.start}',
                                    extendedProps: ${JSON.stringify(event.extendedProps || {})}
                                })">
                                    <div class="flex-shrink-0">
                                        <div class="w-3 h-3 rounded-full ${event.color === '#28a745' ? 'bg-green-500' : 
                                                                           event.color === '#ffc107' ? 'bg-yellow-500' : 
                                                                           event.color === '#dc3545' ? 'bg-red-500' : 'bg-blue-500'}"></div>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-sm font-medium text-gray-900">${event.title}</h4>
                                            <span class="text-xs text-gray-500">${dataHora}</span>
                                        </div>
                                        <p class="text-xs text-gray-600 mt-1">Status: ${event.extendedProps.status || 'N/A'}</p>
                                    </div>
                                </div>
                            `;
                        }).join('');
                    })
                    .catch(error => {
                        console.error('Erro ao carregar próximos agendamentos:', error);
                        document.getElementById('proximos-agendamentos').innerHTML = 
                            '<p class="text-red-500 text-center py-4">Erro ao carregar agendamentos.</p>';
                    });
            }

            // Função global para o onclick
            window.mostrarDetalhesAgendamento = mostrarDetalhesAgendamento;
        });
    </script>

    <style>
        /* Customizações do FullCalendar */
        .fc-theme-standard .fc-scrollgrid {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
        }

        .fc-theme-standard td, .fc-theme-standard th {
            border-color: #f3f4f6;
        }

        .fc-col-header-cell-cushion {
            color: #374151;
            font-weight: 600;
            padding: 0.75rem 0.5rem;
        }

        .fc-daygrid-day-number {
            color: #374151;
            font-weight: 500;
        }

        .fc-button-primary {
            background-color: #6366f1;
            border-color: #6366f1;
        }

        .fc-button-primary:hover {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .fc-button-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .fc-event {
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .fc-event:hover {
            opacity: 0.8;
            transform: translateY(-1px);
        }

        .fc-toolbar-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
        }

        /* Animações */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .fc-toolbar {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .fc-toolbar-chunk {
                justify-content: center;
            }
        }
    </style>
@endsection