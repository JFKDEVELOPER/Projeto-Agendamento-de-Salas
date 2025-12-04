@extends('layouts.app')

@section('title', 'Prioridades - UNC Mafra')

@section('content')
<div class="pt-24 max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Gerenciar Observações das Salas</h1>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário de adicionar observação -->
    <div class="bg-white p-6 rounded-2xl shadow-md mb-8">
        <h2 class="text-lg font-semibold mb-4">Adicionar Observação</h2>
        <form action="{{ route('prioridades.observacao.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="sala_id_add" class="block text-gray-700 font-semibold mb-2">Selecionar Sala</label>
                <select id="sala_id_add" name="sala_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Escolha uma sala --</option>
                    @foreach($salas as $sala)
                        <option value="{{ $sala->id }}">{{ $sala->nome }} (Bloco: {{ $sala->bloco->nome ?? 'N/A' }})</option>
                    @endforeach
                </select>
                @error('sala_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="observacao" class="block text-gray-700 font-semibold mb-2">Observação</label>
                <textarea id="observacao" name="observacao" rows="3" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Digite a observação aqui...">{{ old('observacao') }}</textarea>
                @error('observacao')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-xl shadow transition">
                Adicionar Observação
            </button>
        </form>
    </div>

    <!-- Formulário de remover observação -->
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-lg font-semibold mb-4">Remover Observação</h2>
        <form action="" method="POST" id="formRemoverObservacao">
            @csrf
            @method('DELETE')

            <div class="mb-4">
                <label for="sala_id_remove" class="block text-gray-700 font-semibold mb-2">Selecionar Sala com Observação</label>
                <select id="sala_id_remove" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Escolha uma sala --</option>
                    @foreach($salas as $sala)
                        @if($sala->observacao)
                            <option value="{{ $sala->id }}" data-observacao="{{ $sala->observacao }}">
                                {{ $sala->nome }} (Bloco: {{ $sala->bloco->nome ?? 'N/A' }}) — Observação: {{ $sala->observacao }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-4" id="observacaoAtualContainer" style="display: none;">
                <label class="block text-gray-700 font-semibold mb-2">Observação Atual</label>
                <div id="observacaoAtual" class="p-3 bg-gray-100 rounded border border-gray-300"></div>
            </div>

            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-xl shadow transition" id="btnRemoverObservacao" disabled>
                Remover Observação
            </button>
        </form>
    </div>

</div>

<script>
    const selectRemove = document.getElementById('sala_id_remove');
    const observacaoAtualContainer = document.getElementById('observacaoAtualContainer');
    const observacaoAtual = document.getElementById('observacaoAtual');
    const formRemover = document.getElementById('formRemoverObservacao');
    const btnRemover = document.getElementById('btnRemoverObservacao');

    selectRemove.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const obs = selectedOption.getAttribute('data-observacao');

        if(obs) {
            observacaoAtualContainer.style.display = 'block';
            observacaoAtual.textContent = obs;
            btnRemover.disabled = false;
            formRemover.action = `/prioridades/observacao/${this.value}`; // Atualiza rota dinamicamente
        } else {
            observacaoAtualContainer.style.display = 'none';
            observacaoAtual.textContent = '';
            btnRemover.disabled = true;
            formRemover.action = '';
        }
    });
</script>
@endsection
    