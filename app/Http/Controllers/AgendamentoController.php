<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Advogado;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::with(['cliente', 'advogado'])->get();
        return view('agendamentos', compact('agendamentos'));
    }

    public function create()
    {
        $clientes = Cliente::all(); 
        $advogados = Advogado::all(); 
        return view('agendamentos_create', compact('clientes', 'advogados'));
    }

    public function edit(Agendamento $agendamento)
    {
        $clientes = Cliente::all();
        $advogados = Advogado::all();

        return view('agendamentos_edit', compact('agendamento', 'clientes', 'advogados'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required|date',
            'advogados_id' => 'required|exists:advogados,id',
            'clientes_id' => 'required|exists:clientes,id',
            'descricao' => 'nullable|string|max:255',
        ]);

        Agendamento::create($validatedData);

        return redirect()->route('agendamentos')->with('success', 'Agendamento criado com sucesso!');
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        $validatedData = $request->validate([
            'data' => 'required|date',
            'advogados_id' => 'required|exists:advogados,id',
            'clientes_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string|max:255',
        ]);

        $agendamento->update($validatedData);

        return redirect()->route('agendamentos')->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function destroy(Agendamento $agendamento)
    {
        if ($agendamento->delete()) {
            return redirect()->route('agendamentos')->with('success', 'Agendamento deletado com sucesso!');
        }

        return redirect()->route('agendamentos')->with('error', 'Erro ao deletar agendamento.');
    }
}
