<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use App\Models\Cliente;
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

    public function destroy(Processo $processo)
    {
        $processo->delete();

        return redirect()->route('processos')->with('success', 'Processo deletado com sucesso!');
    }
}
