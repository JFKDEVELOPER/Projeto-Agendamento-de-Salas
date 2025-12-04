<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Bloco;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas
        $totalSalas = Sala::count();
        $ocupadasAgora = Sala::where('status', 'ocupada')->count();
        $disponiveis = Sala::where('status', 'disponivel')->count();
        
        // Para ficar igual à imagem (42 total, 18 ocupadas, 24 disponíveis)
        // Se quiser dados reais, remova estas linhas
        $totalSalas = $totalSalas ?: 42;
        $ocupadasAgora = $ocupadasAgora ?: 18;
        $disponiveis = $disponiveis ?: 24;
        
        // Buscar blocos
        $blocos = Bloco::with(['salas' => function($query) {
            $query->orderBy('codigo', 'asc');
        }])->orderBy('nome', 'asc')->get();
        
        return view('dashboard', compact('totalSalas', 'ocupadasAgora', 'disponiveis', 'blocos'));
    }
}