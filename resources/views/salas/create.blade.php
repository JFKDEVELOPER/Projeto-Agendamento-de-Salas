@extends('layouts.app')

@section('title', 'Nova Sala - UNC Mafra')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Criar Nova Sala</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('salas.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="bloco_id" class="form-label">Bloco *</label>
                            <select class="form-select @error('bloco_id') is-invalid @enderror" id="bloco_id" name="bloco_id" required>
                                <option value="">Selecione um bloco</option>
                                @foreach($blocos as $bloco)
                                    <option value="{{ $bloco->id }}" {{ old('bloco_id') == $bloco->id ? 'selected' : '' }}>
                                        {{ $bloco->nome }} - {{ $bloco->descricao }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bloco_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="codigo" class="form-label">Código da Sala *</label>
                            <input type="text" class="form-control @error('codigo') is-invalid @enderror" 
                                   id="codigo" name="codigo" value="{{ old('codigo') }}" 
                                   placeholder="Ex: A101, B201, C301" required>
                            @error('codigo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Sala *</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                               id="nome" name="nome" value="{{ old('nome') }}" 
                               placeholder="Ex: Sala de Aula 101, Laboratório de Informática" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="capacidade" class="form-label">Capacidade *</label>
                            <input type="number" class="form-control @error('capacidade') is-invalid @enderror" 
                                   id="capacidade" name="capacidade" value="{{ old('capacidade') }}" 
                                   min="1" max="500" required>
                            @error('capacidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="tipo" class="form-label">Tipo de Sala *</label>
                            <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                <option value="">Selecione o tipo</option>
                                <option value="aula" {{ old('tipo') == 'aula' ? 'selected' : '' }}>Sala de Aula</option>
                                <option value="laboratorio" {{ old('tipo') == 'laboratorio' ? 'selected' : '' }}>Laboratório</option>
                                <option value="auditorio" {{ old('tipo') == 'auditorio' ? 'selected' : '' }}>Auditório</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Recursos Disponíveis</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="datashow" id="datashow">
                                    <label class="form-check-label" for="datashow">Datashow/Projetor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="quadro" id="quadro">
                                    <label class="form-check-label" for="quadro">Quadro Branco</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="ar_condicionado" id="ar">
                                    <label class="form-check-label" for="ar">Ar Condicionado</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="computadores" id="computadores">
                                    <label class="form-check-label" for="computadores">Computadores</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="internet" id="internet">
                                    <label class="form-check-label" for="internet">Internet</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="som" id="som">
                                    <label class="form-check-label" for="som">Sistema de Som</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="laboratorio" id="lab">
                                    <label class="form-check-label" for="lab">Laboratório</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="bancada" id="bancada">
                                    <label class="form-check-label" for="bancada">Bancada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recursos[]" value="outros" id="outros">
                                    <label class="form-check-label" for="outros">Outros</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="disponivel" {{ old('status') == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                                <option value="ocupada" {{ old('status') == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                                <option value="manutencao" {{ old('status') == 'manutencao' ? 'selected' : '' }}>Em Manutenção</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control @error('observacoes') is-invalid @enderror" 
                                  id="observacoes" name="observacoes" rows="3" 
                                  placeholder="Informações adicionais sobre a sala...">{{ old('observacoes') }}</textarea>
                        @error('observacoes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('salas.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-unc">
                            <i class="bi bi-save me-1"></i> Salvar Sala
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection