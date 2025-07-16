<?php
namespace App\Main\Fornecedor\Exception;


class FornecedorException extends \Exception
{
    public function __construct(string $message = "", int $code = 501)
    {
        parent::__construct($message, $code);
    }
}