<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Agendamento</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>

<body class="bg-primary text-white">
    <div class="flex h-screen">
        <!-- Menu lateral -->
        <aside class="w-64 bg-sidebar flex flex-col justify-between p-4 shadow-lg min-h-screen">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-lg font-bold">Cassieli</h1>
                        <p class="text-xs text-textTertiary">Lash Designer</p>
                    </div>
                    <button class="text-white">
                        <i data-lucide="menu"></i>
                    </button>
                </div>

                <div class="mb-4">
                    <input type="text" placeholder="Buscar..."
                        class="w-full px-3 py-1 rounded bg-sidebar text-sm focus:outline-none focus:ring focus:ring-accent placeholder-textSecondary" />
                </div>

                <nav class="space-y-2 text-sm">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-3 py-2 rounded hover:bg-sidebar {{ request()->routeIs('dashboard') ? 'bg-accent text-white' : 'text-textSecondary' }}">
                        <i data-lucide="home" class="w-4 h-4 mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('clientes.index') }}"
                        class="flex items-center px-3 py-2 rounded hover:bg-sidebar {{ request()->routeIs('clientes.*') ? 'bg-accent text-white' : 'text-textSecondary' }}">
                        <i data-lucide="users" class="w-4 h-4 mr-2"></i> Clientes
                    </a>
                    <a href="{{ route('profissionais.index') }}"
                        class="flex items-center px-3 py-2 rounded hover:bg-sidebar {{ request()->routeIs('profissionais.*') ? 'bg-accent text-white' : 'text-textSecondary' }}">
                        <i data-lucide="user-check" class="w-4 h-4 mr-2"></i> Profissionais
                    </a>
                    <a href="{{ route('servicos.index') }}"
                        class="flex items-center px-3 py-2 rounded hover:bg-sidebar {{ request()->routeIs('servicos.*') ? 'bg-accent text-white' : 'text-textSecondary' }}">
                        <i data-lucide="layers" class="w-4 h-4 mr-2"></i> Serviços
                    </a>
                    <a href="{{ route('agendamentos.index') }}"
                        class="flex items-center px-3 py-2 rounded hover:bg-sidebar {{ request()->routeIs('agendamentos.*') ? 'bg-accent text-white' : 'text-textSecondary' }}">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i> Agendamentos
                    </a>
                    <a href="{{ route('agendamentos.painel') }}"
                        class="flex items-center px-3 py-2 rounded hover:bg-sidebar {{ request()->routeIs('agendamentos.painel') ? 'bg-accent text-white' : 'text-textSecondary' }}">
                        <i data-lucide="calendar-clock" class="w-4 h-4 mr-2"></i> Painel de Agendamentos
                    </a>
                </nav>
            </div>

            <div class="mt-6 space-y-3 text-sm">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center text-red-400 hover:underline">
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto bg-primary">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>

    <!-- Scripts adicionais para páginas específicas (ex: dashboard com slider) -->
    @yield('scripts')
</body>

</html>
