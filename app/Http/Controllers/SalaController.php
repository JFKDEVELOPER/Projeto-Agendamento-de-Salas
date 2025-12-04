<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Bloco;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    // FORM DE CRIAÇÃO
    public function create()
    {
        $blocos = Bloco::all(); // para o select
        return view('salas.create', compact('blocos'));
    }

    // SALVAR NO BANCO
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:10',
            'capacidade' => 'required|integer|min:1',
            'status' => 'required|string',
            'bloco_id' => 'required|exists:blocos,id',
            'recursos' => 'nullable|array'
        ]);

        Sala::create([
            'codigo' => $request->codigo,
            'capacidade' => $request->capacidade,
            'status' => $request->status,
            'bloco_id' => $request->bloco_id,
            'recursos' => json_encode($request->recursos),
        ]);

        return redirect()->route('dashboard')->with('success', 'Sala criada com sucesso!');
    }
}
