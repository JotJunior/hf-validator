<?php

namespace Jot\HfValidator\Validator;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class CPF
{
    private const CPF_LENGTH = 11;

    public function validate(string $number): bool
    {
        $cpf = $this->sanitizeCpf($number);

        if (!$this->hasValidLength($cpf) || $this->hasRepeatedDigits($cpf)) {
            return false;
        }

        for ($position = 9; $position < self::CPF_LENGTH; $position++) {
            if (!$this->validateCpfDigit($cpf, $position)) {
                return false;
            }
        }

        return true;
    }

    private function sanitizeCpf(string $number): string
    {
        return preg_replace('/\D/', '', $number);
    }

    private function hasValidLength(string $number): bool
    {
        return strlen($number) === self::CPF_LENGTH;
    }

    private function hasRepeatedDigits(string $number): bool
    {
        return preg_match('/(\d)\1{' . (self::CPF_LENGTH - 1) . '}/', $number);
    }

    private function validateCpfDigit(string $number, int $position): bool
    {
        $sum = 0;

        for ($index = 0; $index < $position; $index++) {
            $sum += $number[$index] * (($position + 1) - $index);
        }

        $digit = ((10 * $sum) % 11) % 10;

        return $number[$position] == $digit;
    }

}

