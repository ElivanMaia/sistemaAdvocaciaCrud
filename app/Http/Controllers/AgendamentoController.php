<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Advogado;
use Illuminate\Http\Request;
use App\Http\Requests\AgendamentoRequest;
use Carbon\Carbon;

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

    public function store(AgendamentoRequest $request)
    {
        Agendamento::create($request->validated());

        return redirect()->route('agendamentos')->with('success', 'Agendamento criado com sucesso!');
    }


    public function update(AgendamentoRequest $request, Agendamento $agendamento)
{
    $novaData = Carbon::parse($request->data)->format('Y-m-d H:i:s');
    $dataAtual = Carbon::parse($agendamento->data)->format('Y-m-d H:i:s');

    if (
        $novaData === $dataAtual &&
        $request->advogados_id == $agendamento->advogados_id &&
        $request->clientes_id == $agendamento->clientes_id &&
        ($request->descricao ?? null) === $agendamento->descricao
    ) {
        return redirect()->route('agendamentos')->with('info', 'Nenhuma alteração foi feita.');
    }

    $agendamento->update($request->validated());

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
