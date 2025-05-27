<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Bem-vinda ao Sistema de Agendamento</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
        /* Seu CSS fallback aqui, se quiser */
        </style>
    @endif
</head>
<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] flex flex-col items-center justify-center min-h-screen p-6 lg:p-8"
>
    <header class="w-full max-w-4xl max-w-[335px] mb-8">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-2 rounded-sm border border-gray-300 dark:border-gray-600 hover:bg-pink-600 hover:text-white transition-colors"
                    >
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-2 rounded-sm border border-transparent hover:border-pink-500 hover:text-pink-600 transition-colors"
                    >
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-2 rounded-sm border border-pink-600 text-pink-600 hover:bg-pink-600 hover:text-white transition-colors"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="text-center max-w-md space-y-6">
        <h1 class="text-4xl font-extrabold leading-tight">
            Seja bem-vinda ao <span class="text-pink-600">Sistema de Agendamento</span>
        </h1>
        <p class="text-lg text-gray-700 dark:text-gray-300">
            Organize seus clientes, profissionais e agendamentos com facilidade e agilidade.
        </p>

        <a href="{{ route('register') }}" 
           class="inline-block bg-pink-600 text-white px-8 py-3 rounded-md font-semibold shadow-md hover:bg-pink-700 transition"
        >
            Começar agora
        </a>

        <div class="mt-8 flex items-center justify-center space-x-3 text-gray-600 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span>Interface simples e intuitiva</span>
        </div>
    </main>

    <footer class="mt-auto pt-8 text-sm text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} Cassieli - Todos os direitos reservados.
    </footer>
</body>
</html>
