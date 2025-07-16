<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfCnpjValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $cnpjCpf = preg_replace("/\D/", "", $value);
       $lenght = strlen($cnpjCpf);
       if($lenght < 11 || ($lenght > 11 && $lenght < 14)){
            $fail("cumprimento do cpf ou cnpj é invalido");
        }
    }
}
