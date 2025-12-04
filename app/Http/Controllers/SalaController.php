<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Bloco;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    // FORM DE CRIAÇÃO DE SALA
    public function create()
    {
        $blocos = Bloco::all();  // Para o select de blocos
        $salas  = Sala::all();   // Buscar todas as salas para listagem/exclusão

        return view('salas.create', compact('blocos', 'salas'));
    }

    // SALVAR SALA NO BANCO
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'capacidade' => 'required|integer|min:1',
            'bloco_id' => 'required|exists:blocos,id',
            'recursos' => 'nullable|array'
        ]);

        Sala::create([
            'nome' => $request->nome,
            'capacidade' => $request->capacidade,
            'status' => 'disponivel',
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

    // LISTAR SALAS PARA PRIORIDADES
    public function prioridades()
    {
        $salas = Sala::with('bloco')->get(); // Puxa também informações do bloco
        return view('salas.prioridades', compact('salas'));
    }

    // ADICIONAR OU ATUALIZAR OBSERVAÇÃO
    public function adicionarObservacao(Request $request)
    {
        $request->validate([
            'sala_id' => 'required|exists:salas,id',
            'observacao' => 'required|string|max:500',
        ]);

        $sala = Sala::findOrFail($request->sala_id);
        $sala->observacao = $request->observacao;
        $sala->save();

        return redirect()->route('prioridades')->with('success', 'Observação adicionada com sucesso!');
    }

    // REMOVER OBSERVAÇÃO
    public function removerObservacao(Sala $sala)
    {
        $sala->observacao = null;
        $sala->save();

        return redirect()->route('prioridades')->with('success', 'Observação removida com sucesso!');
    }
}
