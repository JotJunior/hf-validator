<?php

namespace Jot\HfValidator;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class CNPJ extends AbstractAnnotation
{

    private const WEIGHTS_FIRST = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    private const WEIGHTS_SECOND = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    public function __construct(protected string $number)
    {

    }

    /**
     * Validates a CNPJ number by verifying its format and checksum digits.
     *
     * @return bool Returns true if the CNPJ is valid, otherwise false.
     */
    public function validate(): bool
    {
        $sanitizedCNPJ = $this->sanitizeCNPJ($this->number);

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
     * @param string $number The CNPJ string to be sanitized.
     * @return string The sanitized CNPJ containing only numeric characters.
     */
    private function sanitizeCNPJ(string $number): string
    {
        return preg_replace('/[^0-9]/', '', $number);
    }

    /**
     * Validates the format of the given number.
     *
     * @param string $number The number to be validated.
     * @return bool Returns true if the number is valid; otherwise, false.
     */
    private function isValidFormat(string $number): bool
    {
        return strlen($number) === 14 && !preg_match('/(\d)\1{13}/', $number);
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

