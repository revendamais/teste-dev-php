<?php

namespace App\Suppliers\Http\Requests;

use App\Base\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreOrUpdateSupplierRequest extends FormRequest
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
        $supplierId = $this->route('id');

        return [
            'company_name' => 'required|string|max:255',
            'document_type' => 'required|string|in:cpf,cnpj',
            'document_number' => [
                'required',
                'string',
                'max:20',
                'unique:suppliers,document_number' . ($supplierId ? ',' . $supplierId : ''),
                function ($attribute, $value, $fail) {
                    if (!$this->validateDocument($value)) {
                        $fail('O documento informado (CPF ou CNPJ) é inválido.');
                    }
                },
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:suppliers,email' . ($supplierId ? ',' . $supplierId : ''),
            ],
            'telephone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'company_name.required' => 'O nome da empresa é obrigatório.',
            'document_type.required' => 'O tipo de documento é obrigatório.',
            'document_type.in' => 'O tipo de documento deve ser CPF ou CNPJ.',
            'document_number.required' => 'O número do documento é obrigatório.',
            'document_number.unique' => 'O número do documento já está cadastrado.',
            'email.email' => 'O email deve ser um endereço válido.',
            'email.unique' => 'Email já cadastrado.',
            'telephone.max' => 'O telefone não pode exceder 20 caracteres.',
            'address.max' => 'O endereço não pode exceder 255 caracteres.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 400));
    }

    private function validateDocument(string $document): ?string
    {
        $helper = app('App\Base\Helpers\Helper');
        return $helper->validateDocument($document);
    }
}
