<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    private Cliente $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index()
    {
        // Ordena os clientes do mais recente para o mais antigo
        $clientes = $this->cliente->orderBy('created_at', 'desc')->get();
        return view('clients', ['clientes' => $clientes]);
    }

    public function create()
    {
        return view('clients_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
            'data_nasc' => 'nullable|date',
        ]);

        $this->cliente->create($validated);

        return redirect()->route('clients')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Cliente $cliente)
    {
        return view('clients_edit', ['cliente' => $cliente]);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => "required|email|unique:clientes,email,{$cliente->id}",
            'telefone' => 'nullable|string|max:20',
            'cpf' => "required|string|max:14|unique:clientes,cpf,{$cliente->id}",
            'data_nasc' => 'nullable|date',
        ]);

        $updated = $cliente->update($validated);

        return redirect()->back()->with($updated ? 'success' : 'error', 
            $updated ? 'Dados atualizados com sucesso!' : 'Erro ao atualizar dados.');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->delete()) {
            return redirect()->route('clients')->with('success', 'Cliente excluído com sucesso!');
        }

        return redirect()->route('clients')->with('error', 'Erro ao excluir cliente.');
    }
}
