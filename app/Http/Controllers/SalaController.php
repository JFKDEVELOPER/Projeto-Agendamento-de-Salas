@extends('layouts.app')

@section('title', 'Dashboard - UNC Mafra')

@section('content')
<div class="container py-4">
    <!-- Título -->
    <div class="text-center mb-5">
        <h1 class="display-4 text-primary">UNC Mafra</h1>
        <h2 class="text-secondary">Gestão de Salas</h2>
        <p class="lead">Sistema de gerenciamento de salas de aula, laboratórios e auditórios</p>
    </div>

    <!-- Cards de Estatísticas (ZERADOS) -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h1 class="display-1 text-primary">0</h1>
                    <h5 class="card-title">Total de Salas</h5>
                    <p class="text-muted">Nenhuma sala cadastrada</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h1 class="display-1 text-danger">0</h1>
                    <h5 class="card-title">Ocupadas Agora</h5>
                    <p class="text-muted">Nenhuma sala em uso</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h1 class="display-1 text-success">0</h1>
                    <h5 class="card-title">Disponíveis</h5>
                    <p class="text-muted">Todas as salas disponíveis</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensagem para criar primeira sala -->
    <div class="card border-0 shadow-lg">
        <div class="card-body text-center py-5">
            <i class="bi bi-building display-1 text-muted mb-4"></i>
            <h3 class="mb-3">Sistema Vazio</h3>
            <p class="text-muted mb-4">
                Não há salas cadastradas no sistema ainda.<br>
                Você precisa criar os blocos e salas manualmente.
            </p>
            
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Passo 1: Criar Blocos</h5>
                            <p class="small text-muted">Ex: Bloco A, B, C</p>
                            <a href="#" class="btn btn-outline-primary" id="criarBlocoBtn">
                                <i class="bi bi-plus-circle"></i> Criar Primeiro Bloco
                            </a>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5>Passo 2: Criar Salas</h5>
                            <p class="small text-muted">Ex: A101, B201, C301</p>
                            <a href="{{ route('salas.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Criar Primeira Sala
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quando houver salas, esta parte será mostrada -->
    @if($totalSalas > 0)
    <div class="mt-5">
        <h3 class="mb-4">Salas Cadastradas</h3>
        @foreach($blocos as $bloco)
            @if($bloco->salas->count() > 0)
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">{{ $bloco->nome }} - {{ $bloco->descricao }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($bloco->salas as $sala)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $sala->codigo }}</h5>
                                    <p class="card-text">
                                        <strong>Cap:</strong> {{ $sala->capacidade }}<br>
                                        <strong>Tipo:</strong> {{ ucfirst($sala->tipo) }}<br>
                                        <strong>Status:</strong> 
                                        <span class="badge bg-{{ $sala->status == 'disponivel' ? 'success' : ($sala->status == 'ocupada' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($sala->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Função simples para criar bloco (podemos implementar modal depois)
    document.getElementById('criarBlocoBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const nomeBloco = prompt('Digite a letra do bloco (ex: A, B, C):');
        if (nomeBloco) {
            const descricao = prompt('Digite a descrição do bloco (ex: Salas de Aula):');
            if (descricao) {
                // Aqui vamos fazer uma requisição AJAX para criar o bloco
                fetch('{{ route("blocos.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nome: nomeBloco,
                        descricao: descricao
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Bloco criado com sucesso!');
                        location.reload();
                    } else {
                        alert('Erro ao criar bloco: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Erro: ' + error);
                });
            }
        }
    });
</script>
@endpush
@endsection