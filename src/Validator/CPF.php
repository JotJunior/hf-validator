<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class CPF extends AbstractAttribute implements ValidatorInterface
{
    private const CPF_LENGTH = 11;

    public function validate(mixed $value): bool
    {
        $sanitizedCpf = $this->sanitizeCpf($value);

        if (!$this->hasValidLength($sanitizedCpf) || $this->hasRepeatedDigits($sanitizedCpf)) {
            $this->errors[] = 'Malformed CPF number.';
            return false;
        }

        for ($position = 9; $position < self::CPF_LENGTH; $position++) {
            if (!$this->validateCpfDigit($sanitizedCpf, $position)) {
                $this->errors[] = 'Invalid CPF.';
                return false;
            }
        }

        return true;
    }

    private function sanitizeCpf(string $docNumber): string
    {
        return preg_replace('/\D/', '', $docNumber);
    }

    private function hasValidLength(string $docNumber): bool
    {
        return strlen($docNumber) === self::CPF_LENGTH;
    }

    private function hasRepeatedDigits(string $docNumber): bool
    {
        return preg_match('/(\d)\1{' . (self::CPF_LENGTH - 1) . '}/', $docNumber);
    }

    private function validateCpfDigit(string $docNumber, int $position): bool
    {
        $sum = 0;

        for ($index = 0; $index < $position; $index++) {
            $sum += $docNumber[$index] * (($position + 1) - $index);
        }

        $digit = ((10 * $sum) % 11) % 10;

        return $docNumber[$position] == $digit;
    }


}

