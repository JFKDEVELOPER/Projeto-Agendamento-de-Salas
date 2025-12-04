<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ReservaController;

// Página inicial / Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUD de Salas
Route::resource('salas', SalaController::class);

// Página de reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');

// Rota para criar reserva
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

// Rota para remover reserva
Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');

// Página de agenda (não criada ainda)
Route::get('/agenda', function () {
    return 'Página de agenda ainda não criada';
})->name('agenda');

// Página de busca (não criada ainda)
Route::get('/buscar', function () {
    return 'Página de busca ainda não criada';
})->name('buscar');

// Página de mapa (não criada ainda)
Route::get('/mapa', function () {
    return 'Mapa ainda não criado';
})->name('mapa');

// Página de prioridades
Route::get('/prioridades', [SalaController::class, 'prioridades'])->name('prioridades');

// Adicionar observação
Route::post('/prioridades/observacao', [SalaController::class, 'adicionarObservacao'])
    ->name('prioridades.observacao.store');

// Remover observação
Route::delete('/prioridades/observacao/{sala}', [SalaController::class, 'removerObservacao'])
    ->name('prioridades.observacao.destroy');
