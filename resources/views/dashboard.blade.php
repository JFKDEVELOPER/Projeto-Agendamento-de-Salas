@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- Estatísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-2xl p-6">
            <div class="text-gray-500 font-semibold">Total de Salas</div>
            <div class="text-2xl font-bold text-gray-800 mt-2">{{ $totalSalas }}</div>
        </div>

        <div class="bg-white shadow rounded-2xl p-6">
            <div class="text-gray-500 font-semibold">Ocupadas Agora</div>
            <div class="text-2xl font-bold text-red-600 mt-2">{{ $ocupadasAgora }}</div>
        </div>

        <div class="bg-white shadow rounded-2xl p-6">
            <div class="text-gray-500 font-semibold">Disponíveis</div>
            <div class="text-2xl font-bold text-green-600 mt-2">{{ $disponiveis }}</div>
        </div>
    </div>

    <!-- Botões de ação -->
    <div class="flex justify-end gap-4">
        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-xl shadow transition">
            + Nova Reserva
        </button>
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-xl shadow transition">
            Agenda
        </button>
    </div>

    <!-- Listagem por bloco -->
    @foreach($blocos as $bloco)
        <div>
            <h2 class="text-xl font-bold text-gray-800 mt-6 mb-3 flex items-center gap-2">
                📌 Bloco {{ $bloco->nome }} – {{ $bloco->descricao }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($bloco->salas as $sala)
                    @php
                        $cor = [
                            'disponivel' => 'bg-green-500',
                            'ocupada' => 'bg-red-500',
                            'manutencao' => 'bg-yellow-400',
                        ][$sala->status] ?? 'bg-gray-300';
                    @endphp

                    <div class="bg-white rounded-2xl shadow p-4 relative">
                        <div class="font-bold text-gray-800 flex justify-between items-center">
                            {{ $sala->codigo }}
                            <span class="w-3 h-3 rounded-full {{ $cor }}"></span>
                        </div>
                        <div class="text-gray-500 text-sm mt-1">Cap: {{ $sala->capacidade }}</div>
                        <div class="text-gray-500 text-xs mt-2 space-y-1">
                            @foreach(json_decode($sala->recursos ?? '[]') as $r)
                                • {{ $r }} <br>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
