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
        $clientes = $this->cliente->all();

        return view('clients', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
            'data_nasc' => 'nullable|date',
        ]);

        // Criação do cliente
        $created = $this->cliente->create($validated);

        if ($created) {
            return redirect()->back()->with('message', 'Cliente cadastrado com sucesso!');
        }

        return redirect()->back()->with('message', 'Erro ao cadastrar cliente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clients_edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => "required|email|unique:clientes,email,$id",
            'telefone' => 'nullable|string|max:20',
            'cpf' => "required|string|max:14|unique:clientes,cpf,$id",
            'data_nasc' => 'nullable|date',
        ]);

        // Atualização do cliente
        $updated = $this->cliente->where('id', $id)->update($validated);

        if ($updated) {
            return redirect()->back()->with('message', 'Dados atualizados com sucesso!');
        }

        return redirect()->back()->with('message', 'Erro ao atualizar dados.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = $this->cliente->find($id);

        if ($cliente) {
            $cliente->delete();
            return redirect()->route('clients')->with('message', 'Cliente excluído com sucesso!');
        }

        return redirect()->route('clients')->with('message', 'Erro ao excluir cliente.');
    }
}
