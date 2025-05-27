<!-- resources/views/layouts/navigation.blade.php -->
<aside class="w-48 bg-gray-900 text-white h-screen p-4 fixed">
    <div class="mb-6 text-sm font-semibold">
        {{ Auth::user()->name }}
    </div>
    <nav class="space-y-2">
        <a href="{{ route('clientes.index') }}" class="block hover:underline">Clientes</a>
        <a href="{{ route('profissionais.index') }}" class="block hover:underline">Profissionais</a>
        <a href="{{ route('servicos.index') }}" class="block hover:underline">Serviços</a>
        <a href="{{ route(name: 'agendamentos.index') }}" class="block hover:underline">Agendamentos</a>

    </nav>
    <form method="POST" action="{{ route('logout') }}" class="mt-10">
        @csrf
        <button class="text-sm text-pink-400 hover:underline">Logout</button>
    </form>
</aside>
