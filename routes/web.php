<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\BlocoController;

// Página inicial
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUD de Salas (usuário cria)
Route::resource('salas', SalaController::class);

// CRUD de Blocos (simples)
Route::post('/blocos', function() {
    // Implementação básica - você pode criar um controller depois
    request()->validate([
        'nome' => 'required|string|max:1',
        'descricao' => 'required|string'
    ]);
    
    $bloco = App\Models\Bloco::create([
        'nome' => request('nome'),
        'descricao' => request('descricao')
    ]);
    
    return response()->json([
        'success' => true,
        'message' => 'Bloco criado com sucesso',
        'bloco' => $bloco
    ]);
})->name('blocos.store');

// Páginas simples
Route::view('/buscar', 'buscar')->name('buscar');
Route::view('/mapa', 'mapa')->name('mapa');