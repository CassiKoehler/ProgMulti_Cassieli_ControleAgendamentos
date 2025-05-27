@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Painel de Agendamentos</h2>
    <div id="calendar" class="bg-white rounded p-4 text-black"></div>

    {{-- CSS do FullCalendar --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet' />

    {{-- JS do FullCalendar --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales-all.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek', // Exibe a semana como padrão
                locale: 'pt-br',             // Traduz para português
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia'
                },
                events: '/agendamentos/eventos', // Ajuste conforme sua rota
                eventColor: '#f472b6',           // Rosa claro para os eventos
                slotMinTime: '08:00:00',         // Horário inicial do dia
                slotMaxTime: '20:00:00',         // Horário final do dia
            });

            calendar.render();
        });
    </script>

    {{-- Estilo opcional para ajustar cabeçalhos --}}
    <style>
        .fc-col-header-cell-cushion {
            color: #1f2937; /* Texto escuro (Tailwind gray-800) */
            font-weight: bold;
        }

        .fc-toolbar-title {
            font-size: 1.25rem; /* Tamanho do título */
        }
    </style>
@endsection
