<?php

namespace App\Http\Controllers;

use App\Models\HistoricoProcesso;
use App\Models\Processo;
use Illuminate\Http\Request;

class HistoricoProcessoController extends Controller
{
    public function index()
    {
        $historicoProcessos = HistoricoProcesso::where('historico', 'Processo excluído.')->get();
        return view('historicoProcessos', compact('historicoProcessos'));
    }

    public function store(Request $request, Processo $processo)
    {
        $request->validate([
            'historico' => 'required|string|max:255',
        ]);

        $processo->historicos()->create([
            'historico' => $request->historico,
        ]);

        return redirect()->route('processos.historico', $processo->id)->with('message', 'Histórico adicionado com sucesso!');
    }

    public function destroy($historicoId)
{
    $historico = HistoricoProcesso::findOrFail($historicoId);
    $historico->delete();

    return redirect()->route('historicoProcessos')->with('message', 'Histórico excluído com sucesso!');
}


    public function restore($id)
{
    $historico = HistoricoProcesso::findOrFail($id);

    $processo = Processo::onlyTrashed()->findOrFail($historico->processo_id);

    $processo->restore();

    $historico->delete();

    return redirect()->route('historicoProcessos')->with('message', 'Processo restaurado com sucesso!');
}

}


