<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use App\Models\Cliente;
use App\Models\HistoricoProcesso;
use Illuminate\Http\Request;

class ProcessoController extends Controller
{
    public function index()
{
    $processos = Processo::with('cliente')->get();
    return view('processos', compact('processos'));
}


    public function create()
    {
        $clientes = Cliente::all();
        return view('processos_create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'cliente_email' => 'required|exists:clientes,email',
        ]);

        Processo::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'cliente_email' => $request->cliente_email,
        ]);

        return redirect()->route('processos')->with('success', 'Processo criado com sucesso!');
    }

    public function edit(Processo $processo)
    {
        $clientes = Cliente::all();
        return view('processos_edit', compact('processo', 'clientes'));
    }

    public function update(Request $request, Processo $processo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'cliente_email' => 'required|exists:clientes,email',
        ]);

        $processo->update($request->all());

        return redirect()->route('processos')->with('success', 'Processo atualizado com sucesso!');
    }

    public function destroy($id)
{
    $processo = Processo::findOrFail($id);

    HistoricoProcesso::create([
        'processo_id' => $processo->id,
        'historico' => 'Processo excluído.',
        'processo_nome' => $processo->nome,
    ]);

    $processo->delete();

    return redirect()->route('processos')->with('message', 'Processo excluído com sucesso e registrado no histórico!');
}





public function historico($id)
{
    $processo = Processo::findOrFail($id);
    $historicos = HistoricoProcesso::where('processo_id', $processo->id)->get();

    return view('historicoProcessos', compact('processo', 'historicos'));  
}


}
