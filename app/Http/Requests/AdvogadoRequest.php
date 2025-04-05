<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvogadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $advogadoId = $this->advogado?->id ?? null;

        return [
            'nome' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:advogados,email,' . $advogadoId,
            'telefone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^\(\d{2}\)\s\d{4,5}\-\d{4}$/'
            ],
            'cpf' => [
                'required',
                'string',
                'max:14',
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
                'unique:advogados,cpf,' . $advogadoId
            ],
            'area_atuacao' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Formato de e-mail inválido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres.',

            'telefone.regex' => 'Formato de telefone inválido. Ex: (99) 99999-9999',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.regex' => 'Formato de CPF inválido. Ex: 123.456.789-00',
            'cpf.unique' => 'Este CPF já está em uso.',

            'area_atuacao.required' => 'A área de atuação é obrigatória.',
            'area_atuacao.max' => 'A área de atuação deve ter no máximo 255 caracteres.',
        ];
    }
}
