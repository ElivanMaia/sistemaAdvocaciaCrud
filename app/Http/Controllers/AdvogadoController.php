<?php

namespace App\Http\Controllers;

use App\Models\Advogado;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AdvogadoRequest;
use Illuminate\View\View;

class AdvogadoController extends Controller
{
    public function index(): View
    {
        $advogados = Advogado::all();
        return view('advogados', compact('advogados'));
    }

    public function create(): View
    {
        return view('advogados_create');
    }

    public function store(AdvogadoRequest $request): RedirectResponse
    {
        Advogado::create($request->validated());

        return redirect()
            ->route('advogados')
            ->with('success', 'Advogado cadastrado com sucesso!');
    }

    public function edit(Advogado $advogado): View
    {
        return view('advogados_edit', compact('advogado'));
    }

    public function update(AdvogadoRequest $request, Advogado $advogado): RedirectResponse
    {
        if (
            $request->nome === $advogado->nome &&
            $request->email === $advogado->email &&
            $request->telefone === $advogado->telefone &&
            $request->cpf === $advogado->cpf &&
            $request->area_atuacao === $advogado->area_atuacao
        ) {
            return redirect()
                ->route('advogados')
                ->with('info', 'Nenhuma alteração foi feita.');
        }

        $advogado->update($request->validated());

        return redirect()
            ->route('advogados')
            ->with('success', 'Advogado atualizado com sucesso!');
    }



    public function destroy(Advogado $advogado): RedirectResponse
    {
        if ($advogado->delete()) {
            return redirect()
                ->route('advogados')
                ->with('success', 'Advogado excluído com sucesso!');
        }

        return redirect()
            ->route('advogados')
            ->with('error', 'Erro ao excluir advogado.');
    }
}
