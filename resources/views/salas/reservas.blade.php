@extends('layouts.app')

@section('title', 'Nova Reserva')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-2xl shadow mt-10">
    <h1 class="text-2xl font-bold mb-6">Criar Nova Reserva</h1>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulário de criar reserva --}}
    <form action="{{ route('reservas.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nome do reservante --}}
        <div>
            <label class="block font-semibold text-gray-700">Nome do Reservante</label>
            <input type="text" name="nome" required
                class="w-full mt-2 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        {{-- Seleção da sala (apenas disponíveis) --}}
        <div>
            <label class="block font-semibold text-gray-700">Escolher Sala</label>
            <select name="sala_id" required
                class="w-full mt-2 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-400">
                <option disabled selected>Selecione uma sala</option>
                @foreach($salas as $sala)
                    @if($sala->status === 'disponivel')
                        <option value="{{ $sala->id }}">
                            {{ $sala->nome }} – Cap: {{ $sala->capacidade }} – Bloco: {{ $sala->bloco->nome ?? 'N/A' }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- Botão de submit --}}
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-xl transition">
            Reservar
        </button>
    </form>

    {{-- Botão para mostrar reservas --}}
    @if(!empty($reservas) && $reservas->count() > 0)
        <div class="mt-8">
            <button id="btnMostrarReservas" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-xl mb-4 transition">
                Ver / Remover Reservas
            </button>

            <div id="reservasContainer" class="space-y-2 hidden">
                <h2 class="text-xl font-bold mb-4">Salas Reservadas</h2>
                @foreach($reservas as $reserva)
                    <div class="p-3 bg-gray-100 rounded-xl flex justify-between items-center">
                        <div>
                            <strong>Reservante:</strong> {{ $reserva->nome }}<br>
                            <strong>Sala:</strong> 
                            {{ $reserva->sala->nome ?? 'N/A' }} – 
                            Cap: {{ $reserva->sala->capacidade ?? 'N/A' }} – 
                            Bloco: {{ $reserva->sala->bloco->nome ?? 'N/A' }}
                        </div>
                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja remover esta reserva?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-xl transition">
                                Remover
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    const btnMostrarReservas = document.getElementById('btnMostrarReservas');
    const reservasContainer = document.getElementById('reservasContainer');

    if(btnMostrarReservas){
        btnMostrarReservas.addEventListener('click', () => {
            reservasContainer.classList.toggle('hidden');
        });
    }
</script>
@endsection
