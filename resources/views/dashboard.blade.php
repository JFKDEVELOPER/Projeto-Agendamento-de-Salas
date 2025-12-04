@extends('layouts.app')

@section('content')

<!-- Adicionar Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<div class="space-y-8 pt-24 bg-[#F1F5F9] min-h-screen">

    <!-- Estatísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-2xl p-6 flex justify-between items-center">
            <div>
                <div class="text-gray-500 font-semibold">Total de Salas</div>
                <div class="text-2xl font-bold text-gray-800 mt-2">{{ $totalSalas }}</div>
            </div>
            <i class="fas fa-door-open text-3xl text-gray-500"></i>
        </div>

        <div class="bg-white shadow rounded-2xl p-6 flex justify-between items-center">
            <div>
                <div class="text-gray-500 font-semibold">Ocupadas Agora</div>
                <div class="text-2xl font-bold text-red-600 mt-2">{{ $ocupadasAgora }}</div>
            </div>
            <i class="fas fa-user-clock text-3xl text-red-600"></i>
        </div>

        <div class="bg-white shadow rounded-2xl p-6 flex justify-between items-center">
            <div>
                <div class="text-gray-500 font-semibold">Disponíveis</div>
                <div class="text-2xl font-bold text-green-600 mt-2">{{ $disponiveis }}</div>
            </div>
            <i class="fas fa-check-circle text-3xl text-green-600"></i>
        </div>
    </div>

    <!-- Botões de ação -->
    <div class="flex justify-end gap-4 mt-4">
        <a href="{{ route('reservas.index') }}" 
           class="bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-xl shadow transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Nova Reserva
        </a>
        <a href="{{ route('agenda') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-xl shadow flex items-center gap-2 transition">
            <i class="fas fa-calendar-alt"></i> Agenda
        </a>
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

                        // --- Forçar $recursos ser array ---
                        $recursos = [];
                        if (!empty($sala->recursos)) {
                            $decoded = json_decode($sala->recursos, true);

                            if (is_string($decoded)) {
                                $decoded = json_decode($decoded, true);
                            }

                            if (is_array($decoded)) {
                                $recursos = $decoded;
                            }
                        }

                        $reservaNome = optional($sala->reservas->first())->nome;
                        $prioridade = $sala->prioridade ?? null;
                        $observacao = $sala->observacao ?? null;
                    @endphp

                    <div class="bg-white rounded-2xl shadow p-4">
                        <div class="font-bold text-gray-800 flex justify-between items-center">
                            <div>
                                {{ $sala->nome }}
                                @if($prioridade)
                                    <span class="ml-2 px-2 py-1 bg-yellow-200 text-yellow-800 text-xs font-semibold rounded-full">
                                        {{ $prioridade }}
                                    </span>
                                @endif
                            </div>
                            <span class="w-3 h-3 rounded-full {{ $cor }}"></span>
                        </div>

                        <div class="text-gray-500 text-sm mt-1">Cap: {{ $sala->capacidade }}</div>
                        <div class="text-gray-500 text-sm mt-1">Bloco: {{ $sala->bloco->nome ?? 'N/A' }}</div>

                        @if($sala->status === 'ocupada' && $reservaNome)
                            <div class="text-red-600 font-semibold mt-1">Reservado por: {{ $reservaNome }}</div>
                        @endif

                        <div class="text-gray-500 text-xs mt-2">
                            @forelse($recursos as $recurso)
                                <div>• {{ $recurso }}</div>
                            @empty
                                <div>• Nenhum recurso</div>
                            @endforelse
                        </div>

                        {{-- Exibir observação, se houver --}}
                        @if($observacao)
                            <div class="text-gray-700 text-sm mt-2 italic bg-gray-100 p-2 rounded">
                                <strong>Observação:</strong> {{ $observacao }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@endsection
