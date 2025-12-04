<?php

namespace App\Http\Controllers;

use App\Models\Bloco;
use App\Models\Sala;

class DashboardController extends Controller
{
    public function index()
    {
        $blocos = Bloco::with('salas')->get();

        return view('dashboard', [
            'blocos'        => $blocos,
            'totalSalas'    => Sala::count(),
            'ocupadasAgora' => Sala::where('status', 'ocupada')->count(),
            'disponiveis'   => Sala::where('status', 'disponivel')->count(),
        ]);
    }
}
