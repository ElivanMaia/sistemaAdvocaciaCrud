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
    public function edit($id)
{
    $agendamento = Agendamento::with(['cliente', 'advogado'])->find($id);

    if (!$agendamento) {
        return redirect()->route('agendamentos')->with('message', 'Agendamento não encontrado.');
    }

    $clientes = Cliente::all();
    $advogados = Advogado::all();

    return view('agendamentos_edit', compact('agendamento', 'clientes', 'advogados'));
}


public function store(Request $request)
{
    // Validação dos dados recebidos
    $validatedData = $request->validate([
        'data' => 'required|date',
        'advogados_id' => 'required|exists:advogados,id',
        'clientes_id' => 'required|exists:clientes,id',
        'descricao' => 'nullable|string|max:255', // 'nullable' permite que o campo seja opcional
    ]);

    // Criação do novo agendamento
    Agendamento::create($validatedData);

    // Redirecionar com uma mensagem de sucesso
    return redirect()->route('agendamentos')->with('message', 'Agendamento criado com sucesso!');
}


    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::find($id);
    
        if (!$agendamento) {
            return redirect()->route('agendamentos')->with('message', 'Agendamento não encontrado.');
        }
    
        $validatedData = $request->validate([
            'data' => 'required|date',
            'advogados_id' => 'required|exists:advogados,id',
            'clientes_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string|max:255',
        ]);
    
        $agendamento->update($validatedData);
    
        return redirect()->route('agendamentos')->with('message', 'Agendamento atualizado com sucesso!');
    }
    public function destroy($id)
    {
    $agendamento = Agendamento::find($id);


    if (!$agendamento) {
        return redirect()->route('agendamentos')->with('message', 'Agendamento não encontrado.');
    }

    $agendamento->delete();

    return redirect()->route('agendamentos')->with('message', 'Agendamento deletado com sucesso!');
    }

}
