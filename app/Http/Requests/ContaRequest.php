<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'valor' => 'required',
            'vencimento' => 'required',
            'situacao_conta_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Campo Nome é Obrigatório!',
            'valor.required' => 'Campo Valor é Obrigatório!',
            'vencimento.required' => 'Campo Vencimento é Obrigatório!',
            'situacao_conta_id.required' => 'Campo Situação da Conta é Obrigatório!'
        ];
    }
}