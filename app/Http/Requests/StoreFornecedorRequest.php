<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tipo_documento' => 'required|in:CPF,CNPJ',
            'documento' => 'required|unique:fornecedores,documento',
            'nome' => 'required|string',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'endereco' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'documento.required' => 'O campo documento é obrigatório.',
            'documento.unique' => 'CNPJ já está sendo usado ou está incorreto.',
            'tipo_documento.in' => 'Tipo de documento deve ser CPF ou CNPJ.',
            'email.email' => 'E-mail deve ser um endereço válido.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
