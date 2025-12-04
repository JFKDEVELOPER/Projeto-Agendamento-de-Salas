<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalaController;

// Página inicial / Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUD de Salas
Route::resource('salas', SalaController::class);
Route::get('/buscar', function () {
    return 'Página de busca ainda não criada';
})->name('buscar');

Route::get('/mapa', function () {
    return 'Mapa ainda não criado';
})->name('mapa');
