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
        $blocos = Bloco::all();  // para o select
        $salas  = Sala::all();   // buscar todas as salas para exclusão

        return view('salas.create', compact('blocos', 'salas'));
    }

    // SALVAR NO BANCO
    public function store(Request $request)
    {
        // Validação com nome obrigatório
        $request->validate([
            'nome' => 'required|string|max:100',
            'capacidade' => 'required|integer|min:1',
            'bloco_id' => 'required|exists:blocos,id',
            'recursos' => 'nullable|array'
        ]);

        Sala::create([
            'nome' => $request->nome,           // obrigatório
            'capacidade' => $request->capacidade,
            'status' => 'disponivel',           // status padrão
            'bloco_id' => $request->bloco_id,
            'recursos' => json_encode($request->recursos),
        ]);

        return redirect()->route('dashboard')->with('success', 'Sala criada com sucesso!');
    }

    // EXCLUIR SALA
    public function destroy(Sala $sala)
    {
        $sala->delete();

        return redirect()->back()->with('success', 'Sala excluída com sucesso!');
    }
}
