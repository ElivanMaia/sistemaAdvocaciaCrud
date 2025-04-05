<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoricoProcessoRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        // Retorna true para autorizar todos os usuários a fazerem esta requisição.
        // Aqui, você pode adicionar uma verificação de autorização personalizada, se necessário.
        return true;
    }

    /**
     * Obtenha as regras de validação que devem ser aplicadas à solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'historico' => 'required|string|max:255',
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
            'historico.required' => 'O campo histórico é obrigatório.',
            'historico.string' => 'O campo histórico deve ser uma string.',
            'historico.max' => 'O campo histórico não pode ter mais de 255 caracteres.',
        ];
    }
}
