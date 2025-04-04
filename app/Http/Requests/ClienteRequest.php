<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determina se o usuário tem permissão para fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação para a requisição.
     */
    public function rules(): array
    {
        $clienteId = $this->route('cliente'); // Obtém o ID do cliente para evitar erro de unique

        return [
            'nome' => 'required|string|min:3|max:45|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'email' => "required|email|unique:clientes,email,$clienteId",
            'telefone' => 'nullable|string|max:20|regex:/^\(\d{2}\) \d{4,5}-\d{4}$/',
            'cpf' => "required|string|max:14|unique:clientes,cpf,$clienteId|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/",
            'data_nasc' => 'nullable|date|before:today',
        ];
    }

    /**
     * Mensagens personalizadas para os erros de validação.
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'nome.regex' => 'O nome deve conter apenas letras.',
            
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'telefone.regex' => 'Formato inválido. Use (99) 99999-9999.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cpf.regex' => 'Formato inválido. Use 000.000.000-00.',

            'data_nasc.before' => 'A data de nascimento não pode ser no futuro.',
        ];
    }
}
