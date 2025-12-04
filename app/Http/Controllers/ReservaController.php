<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Reserva;

class ReservaController extends Controller
{
    // Página de reservas
    public function index()
    {
        $salas = Sala::where('status', 'disponivel')->get(); // salas disponíveis
        $reservas = Reserva::with('sala.bloco')->get();       // todas as reservas com sala e bloco

        return view('salas.reservas', compact('salas', 'reservas'));
    }

    // Criar nova reserva
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

    // Remover reserva
    public function destroy(Reserva $reserva)
    {
        // Atualizar status da sala para disponível antes de deletar
        $sala = $reserva->sala;
        if($sala){
            $sala->status = 'disponivel';
            $sala->save();
        }

        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva removida com sucesso!');
    }
}
