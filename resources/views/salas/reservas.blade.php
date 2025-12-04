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
                @foreach($salas->where('status', 'disponivel') as $sala)
                    <option value="{{ $sala->id }}">
                        {{ $sala->nome }} – Cap: {{ $sala->capacidade }} – Bloco: {{ $sala->bloco->nome ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botão de submit --}}
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-xl transition">
            Reservar
        </button>
    </form>

    {{-- Lista de reservas existentes --}}
    @if($salasReservadas ?? false)
        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Salas Reservadas</h2>
            <ul class="space-y-2">
                @foreach($salasReservadas as $reserva)
                    <li class="p-3 bg-gray-100 rounded-xl">
                        {{ $reserva->nome }} → Sala: {{ $reserva->sala->nome }} – Cap: {{ $reserva->sala->capacidade }} – Bloco: {{ $reserva->sala->bloco->nome ?? 'N/A' }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
