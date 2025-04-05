<?php

namespace App\Http\Controllers;

use App\Models\HistoricoProcesso;
use App\Models\Processo;
use App\Http\Requests\HistoricoProcessoRequest;

class HistoricoProcessoController extends Controller
{
    public function index()
    {
        $historicoProcessos = HistoricoProcesso::where('historico', 'Processo excluído.')->get();
        return view('historicoProcessos', compact('historicoProcessos'));
    }

    public function store(HistoricoProcessoRequest $request, Processo $processo)
    {
        // Não é mais necessário validar manualmente aqui, pois já foi validado na classe HistoricoProcessoRequest
        $processo->historicos()->create([
            'historico' => $request->historico,
        ]);

        return redirect()->route('processos.historico', $processo->id)
            ->with('success', 'Histórico adicionado com sucesso!');
    }

    public function destroy($historicoId)
    {
        $historico = HistoricoProcesso::find($historicoId);

        if (!$historico) {
            return redirect()->route('historicoProcessos')->with('error', 'Histórico não encontrado.');
        }

        $historico->delete();

        return redirect()->route('historicoProcessos')->with('success', 'Histórico excluído com sucesso!');
    }

    public function restore($id)
{
    $historico = HistoricoProcesso::find($id);

    if (!$historico) {
        return redirect()->route('historicoProcessos')->with('error', 'Histórico não encontrado.');
    }

    $processo = Processo::onlyTrashed()->find($historico->processo_id);

    if (!$processo) {
        return redirect()->route('historicoProcessos')->with('error', 'Processo não encontrado para restauração.');
    }

    $processo->restore();
    $historico->delete();

    return redirect()->route('historicoProcessos')->with('success', 'Processo restaurado com sucesso!');
}

}
