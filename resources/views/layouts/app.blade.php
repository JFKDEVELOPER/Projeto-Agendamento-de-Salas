<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'UNC Mafra – Gestão de Salas')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            margin: 0;
            font-family: "Inter", sans-serif;
        }

        .sidebar {
            width: 260px;
            background-color: #ffffff; /* barra lateral branca */
        }

        .topbar {
            left: 0;
            width: 100%; /* ocupa toda a largura */
            background-color: #1E293B; /* cor hex solicitada */
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100 flex">

<!-- Sidebar -->
<div class="sidebar fixed h-screen bg-white text-[#1E293B] p-6 flex flex-col pt-20"> <!-- pt-20 adiciona espaço para a topbar -->
    <!-- Título da Sidebar -->
    <h2 class="text-lg font-semibold mb-6">Navegação</h2>

    <!-- Links -->
    <a href="{{ route('salas.create') }}" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-100 transition">➕ Criar Sala</a>
    <a href="#" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-100 transition">🔍 Buscar</a>
    <a href="#" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-100 transition">🗺️ Mapa</a>
    <a href="{{ route('prioridades') }}" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-100 transition">
        ⭐ Prioridades
    </a>
</div>


<!-- Topbar -->
<div class="topbar fixed top-0 left-0 right-0 h-16 flex items-center justify-between px-6 shadow-md" style="background-color: #1E293B;">
    <!-- Logo + Texto à esquerda -->
    <div class="flex items-center gap-3">
        <img src="{{ asset('images/unc_logo.jpg') }}" alt="UNC Logo" class="w-12 h-12 -translate-y-1">
        <span class="text-white font-semibold text-lg">UNC Mafra - Gestão de Salas</span>
    </div>

    <!-- Link à direita -->
    <div>
        <a href="{{ route('dashboard') }}" class="text-white hover:underline font-semibold">Início</a>
    </div>
</div>




    <!-- Conteúdo principal -->
    <div class="content ml-[260px] mt-16 p-8 w-full max-w-7xl">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
