<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use App\Models\Cliente;
use App\Models\HistoricoProcesso;
use Illuminate\Http\Request;
use App\Http\Requests\ProcessoRequest;
use Carbon\Carbon;

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
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'cliente_email' => 'required|exists:clientes,email',
        ]);

        Processo::create($validatedData);

        return redirect()->route('processos')->with('success', 'Processo criado com sucesso!');
    }

    public function edit(Processo $processo)
    {
        $clientes = Cliente::all();
        return view('processos_edit', compact('processo', 'clientes'));
    }

    public function update(Request $request, Processo $processo)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:45',
            'descricao' => 'nullable|string',
            'cliente_email' => 'required|exists:clientes,email',
        ]);

        if (
            $request->nome == $processo->nome &&
            $request->descricao == $processo->descricao &&
            $request->cliente_email == $processo->cliente->email
        ) {
            return redirect()->route('processos')->with('info', 'Nenhuma alteração foi feita no processo.');
        }

        $processo->update($validatedData);

        HistoricoProcesso::create([
            'processo_id' => $processo->id,
            'historico' => 'Processo atualizado.',
            'processo_nome' => $processo->nome,
        ]);

        return redirect()->route('processos')->with('success', 'Processo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $processo = Processo::find($id);

        if (!$processo) {
            return redirect()->route('processos')->with('error', 'Processo não encontrado.');
        }

        HistoricoProcesso::create([
            'processo_id' => $processo->id,
            'historico' => 'Processo excluído.',
            'processo_nome' => $processo->nome,
        ]);

        $processo->delete();

        return redirect()->route('processos')->with('success', 'Processo excluído com sucesso e registrado no histórico!');
    }

    public function historico($id)
    {
        $processo = Processo::find($id);

        if (!$processo) {
            return redirect()->route('processos')->with('error', 'Processo não encontrado.');
        }

        $historicos = HistoricoProcesso::where('processo_id', $processo->id)->get();

        return view('historicoProcessos', compact('processo', 'historicos'));
    }
}
