<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function index()
    {
        $salas = Sala::where('status', 'disponivel')->get();
        $reservas = Reserva::with('sala')->get();

        return view('salas.reservas', compact('salas', 'reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sala_id' => 'required|exists:salas,id',
        ]);

        // Criar reserva
        $reserva = Reserva::create([
            'nome' => $request->nome,
            'sala_id' => $request->sala_id,
        ]);

        // Atualizar status da sala para ocupada
        $sala = Sala::find($request->sala_id);
        $sala->status = 'ocupada';
        $sala->save();

        return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
    }
}
