<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessoRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtenha as regras de validação para a solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]*$/',
            'descricao' => 'nullable|string|not_regex:/^\s*$/',
            'cliente_email' => 'required|email|exists:clientes,email',
        ];
    }

    /**
     * Obtenha as mensagens de erro personalizadas.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O nome do processo é obrigatório.',
            'nome.string' => 'O nome do processo deve ser uma string válida.',
            'nome.max' => 'O nome do processo não pode ter mais de 255 caracteres.',
            'nome.regex' => 'O nome do processo pode conter apenas letras, números e espaços.',
            'descricao.string' => 'A descrição deve ser uma string válida.',
            'descricao.not_regex' => 'A descrição não pode ser apenas espaços em branco.',
            'cliente_email.required' => 'O e-mail do cliente é obrigatório.',
            'cliente_email.email' => 'O e-mail fornecido não é válido.',
            'cliente_email.exists' => 'O e-mail informado não corresponde a nenhum cliente.',
        ];
    }
}
