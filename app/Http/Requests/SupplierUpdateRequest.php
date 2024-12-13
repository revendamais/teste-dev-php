<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierUpdateRequest extends FormRequest
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
        $rules = [
            'nome' => ['required', 'string', 'max:255'],
            'empresa' => ['required', 'string', 'max:255', 'unique:suppliers:'],
            'cnpjcpf' => ['required', 'string', 'max:255', 'unique:suppliers'],
            'telefone' => ['required', 'string', 'max:255', 'unique:suppliers'],
            'email' => ['required', 'string', 'max:255', 'unique:suppliers'],
            'endereco' => ['required', 'string', 'max:255'],
        ];

        if($this->method() === 'PUT') {
            $rules['empresa'] = [
                'required',
                'max:255',
                'string',
                Rule::unique('suppliers')->ignore($this->id),
            ];
            $rules['cnpjcpf'] = [
                'required',
                'max:255',
                'string',
                Rule::unique('suppliers')->ignore($this->id),
            ];
            $rules['telefone'] = [
                'required',
                'max:255',
                'string',
                Rule::unique('suppliers')->ignore($this->id),
            ];
            $rules['email'] = [
                'required',
                'max:255',
                'string',
                Rule::unique('suppliers')->ignore($this->id),
            ];
        }

        return $rules;
    }
}
