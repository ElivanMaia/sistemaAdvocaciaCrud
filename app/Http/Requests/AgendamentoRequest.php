<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'data' => 'required|date',
            'advogados_id' => 'required|exists:advogados,id',
            'clientes_id' => 'required|exists:clientes,id',
            'descricao' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['descricao'] = 'nullable|string|max:255';
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            'data.required' => 'A data do agendamento é obrigatória.',
            'data.date' => 'A data informada não é válida.',
            'advogados_id.required' => 'Selecione um advogado.',
            'advogados_id.exists' => 'O advogado selecionado é inválido.',
            'clientes_id.required' => 'Selecione um cliente.',
            'clientes_id.exists' => 'O cliente selecionado é inválido.',
            'descricao.max' => 'A descrição deve ter no máximo 255 caracteres.',
        ];
    }
}
