<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
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

    public function create()
    {
        $clientes = Cliente::all();
        return view('clients_create', compact('clientes'));
    }

    public function store(ClienteRequest $request)
    {
        try {
            Cliente::create($request->validated());
            return redirect()->route('clients')->with('success', 'Cliente cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Erro ao cadastrar cliente.']);
        }
    }

    public function edit(Cliente $cliente)
    {
        $clientes = Cliente::all();
        return view('clients_edit', compact('cliente', 'clientes'));
    }

    public function update(ClienteRequest $request, string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->validated());
            return redirect()->route('clients')->with('success', 'Dados atualizados com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Erro ao atualizar dados.']);
        }
    }

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
