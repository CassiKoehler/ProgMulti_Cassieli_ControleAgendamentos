<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sistema de Agendamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Seja bem Vinda!') }}
                </div>

                <!-- Botões -->
                <div class="p-6 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('clientes.index') }}"
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Clientes
                    </a>
                    <a href="{{ route('profissionais.index') }}"
                        class="inline-block px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 transition">
                        Profissionais
                    </a>
                    <a href="{{ route('servicos.index') }}"
                        class="inline-block px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                        Serviços
                    </a>
                    <a href="{{ route('agendamentos.index') }}"
                        class="inline-block px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                        Agendamentos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>