<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class CNPJ extends AbstractValidator implements ValidatorInterface
{

    private const CNPJ_MASK_PATTERN = '/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/';
    private const WEIGHTS_FIRST = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    private const WEIGHTS_SECOND = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    public const CNPJ_LENGTH = 14;
    public const ERROR_INVALID_CNPJ = 'Invalid CNPJ.';
    public const ERROR_MASK_MISMATCH = 'The provided value does not match the CNPJ mask.';
    private bool $validateMask = false;


    /**
     * Validates a CNPJ (Cadastro Nacional da Pessoa Jurídica) number.
     *
     * @param string $value The CNPJ value to be validated.
     * @return bool True if the CNPJ is valid, false otherwise.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (!is_string($value)) {
            $this->errors[] = self::ERROR_NOT_A_STRING;
            return false;
        }

        if ($this->validateMask && !$this->isValidMask($value)) {
            $this->addError('ERROR_MASK_MISMATCH', self::ERROR_MASK_MISMATCH);
            return false;
        }

        $sanitizedCNPJ = $this->sanitizeCNPJ($value);

        if (!$this->isValidFormat($sanitizedCNPJ)) {
            $this->addError('ERROR_INVALID_CNPJ', self::ERROR_INVALID_CNPJ);
            return false;
        }

        $firstVerifierDigit = $this->calculateDigit(substr($sanitizedCNPJ, 0, 12), self::WEIGHTS_FIRST);
        $secondVerifierDigit = $this->calculateDigit(substr($sanitizedCNPJ, 0, 13), self::WEIGHTS_SECOND);

        $isValid = $sanitizedCNPJ[12] == $firstVerifierDigit && $sanitizedCNPJ[13] == $secondVerifierDigit;

        if (!$isValid) {
            $this->addError('ERROR_INVALID_CNPJ', self::ERROR_INVALID_CNPJ);
        }

        return $isValid;
    }


    /**
     * Checks if the given CNPJ string follows the correct mask format (99.999.999/9999-99).
     *
     * @param string $value The CNPJ value to check.
     * @return bool Returns true if the CNPJ follows the correct mask format; otherwise, false.
     */
    public function isValidMask(string $value): bool
    {
        $pattern = self::CNPJ_MASK_PATTERN;
        return preg_match($pattern, $value) === 1;
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
        return strlen($docNumber) === self::CNPJ_LENGTH && !preg_match('/(\d)\1{13}/', $docNumber);
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

    public function setValidateMask(bool $validateMask): CNPJ
    {
        $this->validateMask = $validateMask;
        return $this;
    }


}

