@extends('layouts.app')

@section('title', 'Todas as Salas - UNC Mafra')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-door-open me-2"></i> Todas as Salas</h2>
    <a href="{{ route('salas.create') }}" class="btn btn-unc">
        <i class="bi bi-plus-circle me-1"></i> Nova Sala
    </a>
</div>

@if($salas->isEmpty())
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-door-closed display-1 text-muted mb-3"></i>
        <h4>Nenhuma sala cadastrada</h4>
        <p class="text-muted">Comece criando sua primeira sala.</p>
        <a href="{{ route('salas.create') }}" class="btn btn-unc">
            <i class="bi bi-plus-circle me-1"></i> Criar Primeira Sala
        </a>
    </div>
</div>
@else
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Bloco</th>
                        <th>Capacidade</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salas as $sala)
                    <tr>
                        <td>
                            <strong>{{ $sala->codigo }}</strong>
                        </td>
                        <td>{{ $sala->nome }}</td>
                        <td>
                            <span class="badge bg-info">{{ $sala->bloco->nome }}</span>
                        </td>
                        <td>{{ $sala->capacidade }} lugares</td>
                        <td>
                            @if($sala->tipo == 'aula')
                                <span class="badge bg-primary">Sala de Aula</span>
                            @elseif($sala->tipo == 'laboratorio')
                                <span class="badge bg-success">Laboratório</span>
                            @else
                                <span class="badge bg-warning">Auditório</span>
                            @endif
                        </td>
                        <td>
                            @if($sala->status == 'disponivel')
                                <span class="badge bg-success">Disponível</span>
                            @elseif($sala->status == 'ocupada')
                                <span class="badge bg-danger">Ocupada</span>
                            @else
                                <span class="badge bg-warning">Manutenção</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('salas.show', $sala->id) }}" class="btn btn-outline-info" title="Ver detalhes">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('salas.edit', $sala->id) }}" class="btn btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('salas.destroy', $sala->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta sala?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-3">
            {{ $salas->links() }}
        </div>
    </div>
</div>
@endif
@endsection