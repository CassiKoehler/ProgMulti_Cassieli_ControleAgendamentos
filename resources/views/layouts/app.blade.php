<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Sistema de Agendamento')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed: 70px;
        }
        
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .menu-item-hover {
            transition: all 0.2s ease-in-out;
        }
        
        .menu-item-hover:hover {
            transform: translateX(4px);
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(167, 139, 250, 0.1));
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .search-focus {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(139, 92, 246, 0.5);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.2);
        }
        
        .floating-header {
            backdrop-filter: blur(20px);
            background: rgba(15, 23, 42, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            color: white;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .profile-avatar {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            position: relative;
            overflow: hidden;
        }
        
        .profile-avatar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
        }
        
        .profile-avatar:hover::before {
            animation: shine 0.5s ease-in-out;
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white min-h-screen">
    <div class="flex h-screen relative">
        <!-- Overlay para mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
        
        <!-- Menu lateral -->
        <aside id="sidebar" class="sidebar-transition fixed lg:relative z-50 w-72 lg:w-72 bg-gradient-to-b from-slate-800/90 to-slate-900/90 glass-effect flex flex-col justify-between shadow-2xl min-h-screen -translate-x-full lg:translate-x-0">
            <div class="p-6">
                <!-- Header do sidebar -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-3">
                        <div class="profile-avatar w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            C
                        </div>
                        <div>
                            <h1 class="text-xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                                Cassieli
                            </h1>
                            <p class="text-xs text-slate-400">Lash Designer</p>
                        </div>
                    </div>
                    <button id="toggle-sidebar" class="text-slate-400 hover:text-white transition-colors lg:hidden">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Barra de busca -->
                <div class="mb-8">
                    <div class="relative">
                        <input type="text" placeholder="Buscar no sistema..." 
                            class="w-full px-4 py-3 pl-10 rounded-xl bg-slate-800/50 border border-slate-700 text-sm focus:outline-none focus:search-focus placeholder-slate-400 transition-all duration-300" />
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>

                <!-- Navegação -->
                <nav class="space-y-2">
                    <div class="text-xs uppercase text-slate-500 font-semibold mb-4 px-3">Menu Principal</div>
                    
                    <a href="{{ route('dashboard') }}" 
                        class="menu-item-hover flex items-center px-4 py-3 rounded-xl group {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-lg' : 'text-slate-300 hover:text-white' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-slate-700 group-hover:bg-purple-600' }} transition-colors mr-3">
                            <i data-lucide="home" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                        @if(request()->routeIs('dashboard'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <a href="{{ route('clientes.index') }}" 
                        class="menu-item-hover flex items-center px-4 py-3 rounded-xl group relative {{ request()->routeIs('clientes.*') ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-lg' : 'text-slate-300 hover:text-white' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('clientes.*') ? 'bg-white/20' : 'bg-slate-700 group-hover:bg-purple-600' }} transition-colors mr-3">
                            <i data-lucide="users" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Clientes</span>
                        <div class="notification-badge">3</div>
                        @if(request()->routeIs('clientes.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <a href="{{ route('profissionais.index') }}" 
                        class="menu-item-hover flex items-center px-4 py-3 rounded-xl group {{ request()->routeIs('profissionais.*') ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-lg' : 'text-slate-300 hover:text-white' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('profissionais.*') ? 'bg-white/20' : 'bg-slate-700 group-hover:bg-purple-600' }} transition-colors mr-3">
                            <i data-lucide="user-check" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Profissionais</span>
                        @if(request()->routeIs('profissionais.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <a href="{{ route('servicos.index') }}" 
                        class="menu-item-hover flex items-center px-4 py-3 rounded-xl group {{ request()->routeIs('servicos.*') ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-lg' : 'text-slate-300 hover:text-white' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('servicos.*') ? 'bg-white/20' : 'bg-slate-700 group-hover:bg-purple-600' }} transition-colors mr-3">
                            <i data-lucide="layers" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Serviços</span>
                        @if(request()->routeIs('servicos.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <div class="text-xs uppercase text-slate-500 font-semibold mb-4 px-3 mt-8">Agendamentos</div>

                    <a href="{{ route('agendamentos.index') }}" 
                        class="menu-item-hover flex items-center px-4 py-3 rounded-xl group relative {{ request()->routeIs('agendamentos.index') ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-lg' : 'text-slate-300 hover:text-white' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('agendamentos.index') ? 'bg-white/20' : 'bg-slate-700 group-hover:bg-purple-600' }} transition-colors mr-3">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Agendamentos</span>
                        <div class="notification-badge">5</div>
                        @if(request()->routeIs('agendamentos.index'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <a href="{{ route('agendamentos.painel') }}" 
                        class="menu-item-hover flex items-center px-4 py-3 rounded-xl group {{ request()->routeIs('agendamentos.painel') ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-lg' : 'text-slate-300 hover:text-white' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('agendamentos.painel') ? 'bg-white/20' : 'bg-slate-700 group-hover:bg-purple-600' }} transition-colors mr-3">
                            <i data-lucide="calendar-clock" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Painel de Agendamentos</span>
                        @if(request()->routeIs('agendamentos.painel'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                </nav>
            </div>

            <!-- Footer do sidebar -->
            <div class="p-6 border-t border-slate-700/50">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-500 flex items-center justify-center">
                            <i data-lucide="user" class="w-4 h-4 text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Online</p>
                            <p class="text-xs text-slate-400">Ativo agora</p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center w-full px-3 py-2 rounded-lg text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all group">
                        <i data-lucide="log-out" class="w-4 h-4 mr-3 group-hover:translate-x-1 transition-transform"></i>
                        <span class="font-medium">Sair do Sistema</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Conteúdo principal -->
        <main class="flex-1 flex flex-col min-h-screen lg:ml-0">
            <!-- Header flutuante -->
            <header class="floating-header sticky top-0 z-30 px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="mobile-menu-btn" class="lg:hidden text-slate-400 hover:text-white transition-colors">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold text-purple-400">@yield('page-title', 'AgendaPro')</h1>
                            <p class="text-sm text-slate-400">@yield('page-description', 'Bem-vindo ao sistema de agendamentos')</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Notificações -->
                        <button class="relative p-2 rounded-lg glass-effect hover:bg-white/10 transition-colors">
                            <i data-lucide="bell" class="w-5 h-5 text-slate-300"></i>
                            <div class="notification-badge">2</div>
                        </button>
                        
                        <!-- Data/Hora -->
                        <div class="hidden md:flex items-center space-x-2 px-3 py-2 rounded-lg glass-effect">
                            <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-sm text-slate-300" id="current-date"></span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Área de conteúdo -->
            <div class="flex-1 p-8 overflow-y-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Inicializar ícones
        lucide.createIcons();
        
        // Data/Hora atual
        function updateDateTime() {
            const now = new Date();
            const options = { 
                day: '2-digit', 
                month: '2-digit', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('current-date').textContent = now.toLocaleDateString('pt-BR', options);
        }
        updateDateTime();
        setInterval(updateDateTime, 60000);
        
        // Mobile menu
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const toggleSidebar = document.getElementById('toggle-sidebar');
        
        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }
        
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }
        
        mobileMenuBtn?.addEventListener('click', openSidebar);
        toggleSidebar?.addEventListener('click', closeSidebar);
        sidebarOverlay?.addEventListener('click', closeSidebar);
        
        // Esc key para fechar sidebar
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });
        
        // Busca com foco
        const searchInput = document.querySelector('input[placeholder*="Buscar"]');
        searchInput?.addEventListener('focus', function() {
            this.parentElement.classList.add('search-focus');
        });
        
        searchInput?.addEventListener('blur', function() {
            this.parentElement.classList.remove('search-focus');
        });
    </script>

    @yield('scripts')
</body>

</html>