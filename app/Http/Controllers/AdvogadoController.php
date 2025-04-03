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
        $advogados = $this->advogado->all();
        return view('advogados', compact('advogados'));
    }

    public function create()
    {
        return view('advogados_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:advogados,email',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'required|string|max:14|unique:advogados,cpf',
            'area_atuacao' => 'required|string|max:255',
        ]);

        $this->advogado->create($validated);

        return redirect()->route('advogados')->with('success', 'Advogado cadastrado com sucesso!');
    }

    public function edit(Advogado $advogado)
    {
        return view('advogados_edit', compact('advogado'));
    }

    public function update(Request $request, Advogado $advogado)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => "required|email|unique:advogados,email,{$advogado->id}",
            'telefone' => 'nullable|string|max:20',
            'cpf' => "required|string|max:14|unique:advogados,cpf,{$advogado->id}",
            'area_atuacao' => 'required|string|max:255',
        ]);

        $advogado->update($validated);

        return redirect()->route('advogados')->with('success', 'Dados atualizados com sucesso!');
    }

    public function destroy(Advogado $advogado)
    {
        if ($advogado->delete()) {
            return redirect()->route('advogados')->with('success', 'Advogado excluído com sucesso!');
        }

        return redirect()->route('advogados')->with('error', 'Erro ao excluir advogado.');
    }
}
