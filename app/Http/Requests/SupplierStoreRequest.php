<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'empresa' => 'required|max:255|unique:suppliers',
            'cnpjcpf' => 'required|max:14|unique:suppliers',
            'telefone' => 'required|max:14|unique:suppliers',
            'email' => 'required|max:255|unique:suppliers',
            'endereco' => 'required|max:255',
        ];
    }
}
