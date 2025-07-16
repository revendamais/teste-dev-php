<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpjValidation;
use App\Rules\EmailValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class FornecedorRequest extends FormRequest
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
            "id"        => ["nullable"],
            "nome"      => ['required'],
            "cpf_cnpj"  => ['required', new CpfCnpjValidation],
            "email"     => ['required', new EmailValidation],
            "celular"   => ['required'],
            "endereco"  => ['required']
        ];
    }

    public function messages() : array
    {
        return [
            "nome.required"      => 'nome é obritaótio',
            "cpf_cnpj.required"  => 'cpf ou cnpj é obritaótio',
            "email.required"     => 'email é obritaótio',
            "celular.required"   => 'celular é obritaótio',
            "endereco.required " => 'endereço é obritaótio'
        ];
    }


    public function nome() : ?string
    {
        return $this->nome;
    }

    public function email() : ?string
    {
        return $this->email;
    }

    public function cpfCnpj() : ?string
    {
        $cnpj = preg_replace("/\D/", "", $this->cpf_cnpj);
        return $cnpj;
    }

    public function celular(): ?string
    {
        return $this->celular;
    }

    public function endereco(): ?string
    {
        return $this->endereco;
    }

    public function id() 
    {
        if (empty($this->id)) {
            throw new \Exception("identificador não informado", 422);
        }
        return $this->id;
    }
}
