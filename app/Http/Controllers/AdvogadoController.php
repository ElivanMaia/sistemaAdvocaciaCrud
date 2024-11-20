<?php

namespace App\Http\Controllers;

use App\Models\Advogado;
use Illuminate\Http\Request;

class AdvogadoController extends Controller
{
    public readonly Advogado $advogado;

    public function __construct()
    {
        $this->advogado = new Advogado();
    }


    public function index()
    {
        $advogados = $this->advogado->All();

        return view ('advogados', ['advogados' => $advogados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('advogados_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = $this->advogado->create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'cpf' => $request->input('cpf'),
            'area_atuacao' => $request->input('data_nasc'),
        ]);

        if($created)
        {
            return redirect()->back()->with('message', 'Advogado cadastrado com sucesso');
        }

        return redirect()->back()->with('message', 'Erro ao cadastrar advogado');
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
    public function edit(Advogado $advogado)
    {
        return view('advogados_edit', ['advogado' => $advogado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = $this->advogado->where('id', $id)->update($request->except(['_token','_method']));

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
    $advogado = $this->advogado->find($id);

    if ($advogado) {
        $advogado->delete();
        return redirect()->route('advogados')->with('message', 'Cliente excluído com sucesso!');
    }

    return redirect()->route('advogados')->with('message', 'Erro ao excluir cliente.');
}

}
