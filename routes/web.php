<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ReservaController; // <- IMPORT CORRETO

// Página inicial / Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUD de Salas
Route::resource('salas', SalaController::class);

// Página de reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');

// Rota para criar reserva
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

// Página de busca
Route::get('/buscar', function () {
    return 'Página de busca ainda não criada';
})->name('buscar');

// Página de mapa
Route::get('/mapa', function () {
    return 'Mapa ainda não criado';
})->name('mapa');
