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
        $clientes = $this->cliente->All();

        return view ('clients', ['clientes' => $clientes]);
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
        $created = $this->cliente->create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'cpf' => $request->input('cpf'),
            'data_nasc' => $request->input('data_nasc'),
        ]);

        if($created)
        {
            return redirect()->back()->with('message', 'Cliente cadastrado com sucesso');
        }

        return redirect()->back()->with('message', 'Erro ao cadastrar cliente');
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
        $updated = $this->cliente->where('id', $id)->update($request->except(['_token','_method']));

        if($updated)
        {
            return redirect()->back()->with('message', 'Dados atualizados com sucesso');
        }

        return redirect()->back()->with('message', 'Erro ao atualizar dados');
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
