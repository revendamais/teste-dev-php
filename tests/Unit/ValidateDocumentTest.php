<?php

use danielbastos\revendamais\Rules\ValidateDocument;
use PHPUnit\Framework\TestCase;

class ValidateDocumentTest extends TestCase
{
    public function test_valid_cpf()
    {
        $rule = new ValidateDocument();
        $failCalled = false;
        $fail = function() use (&$failCalled) { $failCalled = true; };

        // CPF válido: 529.982.247-25
        $rule->validate('document', '529.982.247-25', $fail);
        $this->assertFalse($failCalled);
    }

    public function test_invalid_cpf()
    {
        $rule = new ValidateDocument();
        $failCalled = false;
        $fail = function() use (&$failCalled) { $failCalled = true; };

        // CPF inválido
        $rule->validate('document', '123.456.789-00', $fail);
        $this->assertTrue($failCalled);
    }

    public function test_valid_cnpj()
    {
        $rule = new ValidateDocument();
        $failCalled = false;
        $fail = function() use (&$failCalled) { $failCalled = true; };

        // CNPJ válido: 04.252.011/0001-10
        $rule->validate('document', '04.252.011/0001-10', $fail);
        $this->assertFalse($failCalled);
    }

    public function test_invalid_cnpj()
    {
        $rule = new ValidateDocument();
        $failCalled = false;
        $fail = function() use (&$failCalled) { $failCalled = true; };

        // CNPJ inválido
        $rule->validate('document', '00.000.000/0000-00', $fail);
        $this->assertTrue($failCalled);
    }

    public function test_invalid_length()
    {
        $rule = new ValidateDocument();
        $failCalled = false;
        $fail = function() use (&$failCalled) { $failCalled = true; };

        // Documento com tamanho inválido
        $rule->validate('document', '12345', $fail);
        $this->assertTrue($failCalled);
    }
}