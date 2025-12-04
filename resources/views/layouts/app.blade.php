<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'UNC Mafra – Gestão de Salas')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Estilo fixo da sidebar e topbar -->
    <style>
        body {
            margin: 0;
            font-family: "Inter", sans-serif;
        }

        .sidebar {
            width: 260px;
        }

        .topbar {
            left: 260px;
        }

        /* Pequena animação opcional para conteúdo */
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- Estilos adicionais da página -->
    @stack('styles')
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="sidebar fixed h-screen bg-gray-900 text-white p-6 flex flex-col">
        <h2 class="text-lg font-semibold mb-6 flex items-center gap-2">🏫 UNC Mafra</h2>
        <a href="{{ route('salas.create') }}" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-800 transition">➕ Criar Sala</a>
        <a href="#" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-800 transition">🔍 Buscar</a>
        <a href="#" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-800 transition">🗺️ Mapa</a>
        <a href="#" class="flex items-center p-3 mb-2 rounded-lg hover:bg-gray-800 transition">⭐ Prioridades</a>
    </div>

    <!-- Topbar -->
    <div class="topbar fixed top-0 right-0 h-16 bg-gray-800 text-white flex items-center justify-end px-6 shadow-md">
        <a href="{{ route('dashboard') }}" class="hover:underline">
            Início
        </a>
    </div>


    <!-- Conteúdo principal -->
    <div class="content ml-[260px] mt-16 p-8 w-full max-w-7xl">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
