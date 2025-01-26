<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class CNPJ extends AbstractAttribute implements ValidatorInterface
{

    private const WEIGHTS_FIRST = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    private const WEIGHTS_SECOND = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    /**
     * Validates a CNPJ number by verifying its format and checksum digits.
     *
     * @return bool Returns true if the CNPJ is valid, otherwise false.
     */
    public function validate(string $value, array $options = []): bool
    {
        $sanitizedCNPJ = $this->sanitizeCNPJ($value);

        if (!$this->isValidFormat($sanitizedCNPJ)) {
            return false;
        }

        $firstVerifierDigit = $this->calculateDigit(substr($sanitizedCNPJ, 0, 12), self::WEIGHTS_FIRST);
        $secondVerifierDigit = $this->calculateDigit(substr($sanitizedCNPJ, 0, 13), self::WEIGHTS_SECOND);

        return $sanitizedCNPJ[12] == $firstVerifierDigit && $sanitizedCNPJ[13] == $secondVerifierDigit;
    }

    /**
     * Removes all non-numeric characters from the given CNPJ string.
     *
     * @param string $docNumber The CNPJ string to be sanitized.
     * @return string The sanitized CNPJ containing only numeric characters.
     */
    private function sanitizeCNPJ(string $docNumber): string
    {
        return preg_replace('/[^0-9]/', '', $docNumber);
    }

    /**
     * Validates the format of the given number.
     *
     * @param string $docNumber The number to be validated.
     * @return bool Returns true if the number is valid; otherwise, false.
     */
    private function isValidFormat(string $docNumber): bool
    {
        return strlen($docNumber) === 14 && !preg_match('/(\d)\1{13}/', $docNumber);
    }

    /**
     * Calculates a check digit based on the provided base and weights.
     *
     * @param string $base The base string consisting of numeric characters.
     * @param array $weights An array of integers representing weights to be applied to each digit of the base.
     * @return int The calculated check digit.
     */
    private function calculateDigit(string $base, array $weights): int
    {
        $sum = 0;
        foreach (str_split($base) as $i => $digit) {
            $sum += $digit * $weights[$i];
        }
        $remainder = $sum % 11;
        return $remainder < 2 ? 0 : 11 - $remainder;
    }
}

