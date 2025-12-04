@extends('layouts.app')

@section('title', 'Dashboard - UNC Mafra')

@section('content')
<!-- Cards de Estatísticas -->
<div class="row mb-5">
    <div class="col-md-4 mb-3">
        <div class="card stats-card border-0 bg-white">
            <div class="card-body text-center">
                <div class="stats-number text-primary">{{ $totalSalas }}</div>
                <div class="stats-label text-secondary">Total de Salas</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card stats-card border-0 bg-white">
            <div class="card-body text-center">
                <div class="stats-number text-danger">{{ $ocupadasAgora }}</div>
                <div class="stats-label text-secondary">Ocupadas Agora</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card stats-card border-0 bg-white">
            <div class="card-body text-center">
                <div class="stats-number text-success">{{ $disponiveis }}</div>
                <div class="stats-label text-secondary">Disponíveis</div>
            </div>
        </div>
    </div>
</div>

<!-- Listagem de Salas por Bloco -->
@foreach($blocos as $bloco)
<div class="bloco-card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-building me-2"></i>{{ $bloco->descricao }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($bloco->salas as $sala)
            @php
                $recursosTraduzidos = [
                    'datashow' => 'Datashow',
                    'lab_info' => 'Lab. Info',
                    'computadores' => 'Computadores',
                    'quadro' => 'Quadro',
                    'manutencao' => 'Manutenção',
                    '30_pcs' => '30 PCs',
                    'microscopios' => 'Microscópios',
                    'bancada' => 'Bancada',
                    'bancada_quimica' => 'Bancada Química',
                    'exaustor' => 'Exaustor',
                    'projetor' => 'Projetor',
                    'som' => 'Som',
                    'palco' => 'Palco',
                    'ar_condicionado' => 'Ar Condicionado',
                    'tela' => 'Tela',
                    'lab' => 'Laboratório',
                    'internet' => 'Internet',
                    'outros' => 'Outros',
                ];
                
                $recursosArray = json_decode($sala->recursos, true) ?? [];
                $recursosTexto = '';
                if (!empty($recursosArray)) {
                    $recursosTraduzidosArray = array_map(function($item) use ($recursosTraduzidos) {
                        return $recursosTraduzidos[$item] ?? $item;
                    }, $recursosArray);
                    $recursosTexto = implode(', ', $recursosTraduzidosArray);
                }
            @endphp
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 sala-card border-{{ $sala->status == 'disponivel' ? 'success' : ($sala->status == 'ocupada' ? 'danger' : 'warning') }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ $sala->codigo }}</h5>
                            <span class="badge bg-{{ $sala->status == 'disponivel' ? 'success' : ($sala->status == 'ocupada' ? 'danger' : 'warning') }}">
                                {{ ucfirst($sala->status) }}
                            </span>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $sala->nome }}</h6>
                        <p class="card-text">
                            <strong>Capacidade:</strong> {{ $sala->capacidade }} pessoas
                        </p>
                        @if($recursosTexto)
                        <p class="card-text">
                            <small class="text-muted">
                                <strong>Recursos:</strong> {{ $recursosTexto }}
                            </small>
                        </p>
                        @endif
                        <div class="mt-3">
                            <a href="{{ route('salas.show', $sala->id) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
                            <a href="{{ route('salas.edit', $sala->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach

@if($totalSalas === 0)
<div class="text-center py-5">
    <i class="bi bi-building display-1 text-muted"></i>
    <h4 class="mt-3">Nenhuma sala cadastrada</h4>
    <p class="text-muted">Comece criando sua primeira sala clicando no botão abaixo ou no menu "Nova Sala".</p>
    <a href="{{ route('salas.create') }}" class="btn btn-unc btn-lg">
        <i class="bi bi-plus-circle me-2"></i> Criar Primeira Sala
    </a>
</div>
@endif
@endsection

@push('styles')
<style>
    .stats-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .stats-number {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 10px;
    }
    
    .stats-label {
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.9;
    }
    
    .sala-card {
        transition: transform 0.3s;
    }
    
    .sala-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush