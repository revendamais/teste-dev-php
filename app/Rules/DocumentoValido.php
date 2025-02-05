<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentoValido implements Rule {
    public function passes($attribute, $value) {
        $documento = preg_replace('/\D/', '', $value); // Remove caracteres não numéricos

        if (strlen($documento) === 11) {
            return $this->validarCpf($documento);
        } elseif (strlen($documento) === 14) {
            return $this->validarCnpj($documento);
        }

        return false;
    }

    public function message() {
        return 'O campo :attribute não é um CPF ou CNPJ válido.';
    }

    private function validarCpf($cpf) {
        if (preg_match('/(\d)\1{10}/', $cpf)) return false; // Impede sequências repetidas

        $soma1 = 0;
        $soma2 = 0;
        for ($i = 0, $j = 10; $i < 9; $i++, $j--) {
            $soma1 += $cpf[$i] * $j;
            $soma2 += $cpf[$i] * ($j + 1);
        }

        $d1 = ($soma1 * 10) % 11;
        $d1 = ($d1 == 10) ? 0 : $d1;

        $soma2 += $d1 * 2;
        $d2 = ($soma2 * 10) % 11;
        $d2 = ($d2 == 10) ? 0 : $d2;

        return $d1 == $cpf[9] && $d2 == $cpf[10];
    }

    private function validarCnpj($cnpj) {
        if (preg_match('/(\d)\1{13}/', $cnpj)) return false; // Impede sequências repetidas

        $pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $soma1 = 0;
        $soma2 = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma1 += $cnpj[$i] * $pesos1[$i];
            $soma2 += $cnpj[$i] * $pesos2[$i];
        }

        $d1 = ($soma1 % 11) < 2 ? 0 : 11 - ($soma1 % 11);
        $soma2 += $d1 * $pesos2[12];
        $d2 = ($soma2 % 11) < 2 ? 0 : 11 - ($soma2 % 11);

        return $d1 == $cnpj[12] && $d2 == $cnpj[13];
    }
}
