<?php

namespace danielbastos\revendamais\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateDocument implements ValidationRule
{

    private function validateCnpj(string $cnpj): bool
    {
        // reject repeated chars
        if (preg_match('/^(\d)\1{13}$/', $cnpj))  return false;

        // validate digits
        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            $m = $t - 7;
            for ($i = 0; $i < $t; $i++) {
                $d += $cnpj[$i] * $m--;
                if ($m < 2) $m = 9;
            }
            $dv = ((10 * $d) % 11) % 10;
            if ($cnpj[$t] != $dv) {
                return false;
            }
        }

        return true;
    }

    private function validateCpf(string $cpf): bool
    {
        // reject repeated chars
        if (preg_match('/^(\d)\1{10}$/', $cpf)) return false;

        // validate digits
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $dv = ((10 * $d) % 11) % 10;
            if ($cpf[$t] != $dv) {
                return false;
            }
        }

        return true;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail                       
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $document = preg_replace('/[^0-9]/', '', $value);

        if (strlen($document) == 14) {
            if (!$this->validateCnpj($document)) {
                $fail('Invalid document number.');
                return;
            }
        }
        elseif (strlen($document) == 11) {
            if (!$this->validateCPF($document)) {
                $fail('Invalid document number.');
                return;
            }
        }
        else $fail('Invalid document number.');
    }
}
