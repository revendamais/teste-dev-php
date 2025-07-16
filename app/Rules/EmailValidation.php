<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //aceita um email valido com final: .com ou .com.br
        $emailPattern = "/[\w.-]*[@]{1}[a-z]{2,}[.]{1}[a-z]{2,}([.]br)?$/";
        preg_match($emailPattern, $value, $match);
        if (empty($match)) {
            $fail("email invalido.");
        }
    }
}
