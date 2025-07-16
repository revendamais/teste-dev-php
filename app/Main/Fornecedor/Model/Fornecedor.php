<?php
namespace App\Main\Fornecedor\Model;

class Fornecedor
{
    public function __construct(
        public readonly ?string $nome,
        public readonly ?string $cpf_cnpj,
        public readonly ?string $email,
        public readonly ?string $celular,
        public readonly ?string $endereco,
        public readonly ?int $id = null,
    ){}


    public function getCpfCnpj() : ?string
    {
        return $this->cpf_cnpj;
    }
    public function isCpf()
    {
        return strlen($this->cpf_cnpj) === 11;
    }
    public function isCnpj()
    {
        return strlen($this->cpf_cnpj) === 14;
    }

    public function setCpfCnpf(string $cpfCnpj)
    {
        $this->cpf_cnpj = $cpfCnpj;
    }
    
    public function toArray() : array
    {
        return [
            "id"        => $this->id,
            "nome"      => $this->nome,
            "cpf_cnpj"  => $this->cpf_cnpj,
            "email"     => $this->email,
            "celular"   => $this->celular,
            "endereco"  => $this->endereco
        ];
    }
}