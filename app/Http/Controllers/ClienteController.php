<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public readonly Cliente $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function index()
    {
        $clientes = Cliente::all();
        return view('clients', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('clients_create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
            'data_nasc' => 'nullable|date',
        ]);

        $created = $this->cliente->create($validated);

        if ($created) {
            return redirect()->route('clients')->with('success', 'Cliente cadastrado com sucesso!');
        }

        return redirect()->route('clients')->with('error', 'Erro ao cadastrar cliente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $clientes = Cliente::all();
        return view('clients_edit', compact('cliente', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => "required|email|unique:clientes,email,$id",
            'telefone' => 'nullable|string|max:20',
            'cpf' => "required|string|max:14|unique:clientes,cpf,$id",
            'data_nasc' => 'nullable|date',
        ]);

        $updated = $this->cliente->where('id', $id)->update($validated);

        if ($updated) {
            return redirect()->route('clients')->with('success', 'Dados atualizados com sucesso!');
        }

        return redirect()->route('clients')->with('error', 'Erro ao atualizar dados.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = $this->cliente->find($id);

        if ($cliente) {
            $cliente->delete();
            return redirect()->route('clients')->with('success', 'Cliente excluído com sucesso!');
        }

        return redirect()->route('clients')->with('error', 'Erro ao excluir cliente.');
    }
}
