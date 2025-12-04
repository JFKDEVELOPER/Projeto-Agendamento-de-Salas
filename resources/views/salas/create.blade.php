@extends('layouts.app')

@section('title', 'Criar Sala')

@section('content')
<div class="min-h-screen bg-gray-100 flex justify-center py-12 px-4 animate-fadeIn">

    <div class="w-full max-w-xl bg-white shadow-xl rounded-3xl p-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-3">
            <span class="text-blue-600 text-4xl">+</span> Criar Nova Sala
        </h1>

        <form action="{{ route('salas.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Sala --}}
            <div>
                <label class="block text-gray-700 font-semibold">Sala</label>
                <input type="text" name="codigo" placeholder="Ex: A101" required
                    class="w-full mt-2 px-4 py-3 bg-gray-50 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-400 focus:bg-white transition">
            </div>

            {{-- Capacidade --}}
            <div>
                <label class="block text-gray-700 font-semibold">Capacidade</label>
                <input type="number" min="1" step="1" name="capacidade" placeholder="Ex: 40" required
                    class="w-full mt-2 px-4 py-3 bg-gray-50 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-400 focus:bg-white transition">
            </div>

            {{-- Bloco --}}
            <div>
                <label class="block text-gray-700 font-semibold">Bloco</label>
                <select name="bloco_id" required
                    class="w-full mt-2 px-4 py-3 bg-gray-50 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-400 transition">
                    <option disabled selected>Selecione um bloco</option>
                    @foreach($blocos as $bloco)
                        <option value="{{ $bloco->id }}">
                            {{ $bloco->nome }} – {{ $bloco->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Recursos --}}
            <div>
                <label class="block text-gray-700 font-semibold">Recursos (opcional)</label>
                <select id="recursos" name="recursos[]" multiple
                    class="w-full mt-2 h-40 px-4 py-2 bg-gray-50 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-400 transition">
                    <option value="Projetor">Projetor</option>
                    <option value="Computadores">Computadores</option>
                    <option value="Ar-condicionado">Ar-condicionado</option>
                    <option value="TV">TV</option>
                </select>

                <div class="flex gap-3 mt-3">
                    <input id="novoRecurso" type="text" placeholder="Adicionar recurso personalizado"
                        class="flex-1 px-4 py-3 bg-gray-50 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-400 transition">
                    <button type="button" onclick="adicionarRecurso()"
                        class="px-5 py-3 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-2xl transition transform hover:scale-105">
                        Adicionar
                    </button>
                </div>
            </div>

            {{-- Botão salvar --}}
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-2xl shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
                    Salvar Sala
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function adicionarRecurso() {
    const campo = document.getElementById("novoRecurso");
    const valor = campo.value.trim();
    const select = document.getElementById("recursos");

    if (!valor) {
        alert("Digite um recurso antes de adicionar.");
        return;
    }

    const option = document.createElement("option");
    option.value = valor;
    option.text = valor;
    option.selected = true;
    select.appendChild(option);
    campo.value = "";
}
</script>
@endpush
