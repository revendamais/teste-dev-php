<?php

declare(strict_types=1);

namespace App\Base\Helpers;

class Helper
{
    public function validateDocument(string $document): ?string
    {
        $document = preg_replace('/[^0-9]/', '', $document);

        if (strlen($document) === 11) {
            if ($this->validateCpf($document)) {
                return $document;
            }
            return null;
        }

        if (strlen($document) === 14) {
            if ($this->validateCnpj($document)) {
                return $document;
            }
            return null;
        }

        return null;
    }

    private function validateCpf(string $cpf): bool
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $weights1 = range(10, 2);
        $sum1 = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum1 += $cpf[$i] * $weights1[$i];
        }
        $remainder1 = $sum1 % 11;
        $digit1 = $remainder1 < 2 ? 0 : 11 - $remainder1;

        if ((int)$cpf[9] !== $digit1) {
            return false;
        }

        $weights2 = range(11, 2);
        $sum2 = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum2 += $cpf[$i] * $weights2[$i];
        }
        $remainder2 = $sum2 % 11;
        $digit2 = $remainder2 < 2 ? 0 : 11 - $remainder2;

        return (int)$cpf[10] === $digit2;
    }

    private function validateCnpj(string $cnpj): bool
    {
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        $weights1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $sum1 = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum1 += $cnpj[$i] * $weights1[$i];
        }
        $remainder1 = $sum1 % 11;
        $digit1 = $remainder1 < 2 ? 0 : 11 - $remainder1;

        if ((int)$cnpj[12] !== $digit1) {
            return false;
        }

        $weights2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $sum2 = 0;
        for ($i = 0; $i < 13; $i++) {
            $sum2 += $cnpj[$i] * $weights2[$i];
        }
        $remainder2 = $sum2 % 11;
        $digit2 = $remainder2 < 2 ? 0 : 11 - $remainder2;

        return (int)$cnpj[13] === $digit2;
    }


}