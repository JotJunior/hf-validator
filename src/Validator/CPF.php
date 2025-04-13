<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;

use function Hyperf\Translation\__;

class CPF extends AbstractValidator implements ValidatorInterface
{
    public const CPF_LENGTH = 11;

    private const CPF_MASK_PATTERN = '/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/';

    private bool $validateMask = false;

    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! is_string($value)) {
            $this->errors[] = self::ERROR_NOT_A_STRING;
            return false;
        }

        if ($this->validateMask && ! $this->isValidMask($value)) {
            $this->errors[] = __('hf-validator.error_mask_mismatch');
        }

        $sanitizedCpf = $this->sanitizeCpf($value);

        if (! $this->hasValidLength($sanitizedCpf) || $this->hasRepeatedDigits($sanitizedCpf)) {
            $this->errors[] = __('hf-validator.error_malformed_cpf');
        }

        for ($position = 9; $position < self::CPF_LENGTH; ++$position) {
            if (! $this->validateCpfDigit($sanitizedCpf, $position)) {
                $this->errors[] = __('hf-validator.error_invalid_cpf');
            }
        }

        return count($this->errors) === 0;
    }

    public function isValidMask(string $value): bool
    {
        $pattern = self::CPF_MASK_PATTERN;
        return preg_match($pattern, $value) === 1;
    }

    public function setValidateMask(bool $validateMask): CPF
    {
        $this->validateMask = $validateMask;
        return $this;
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
        return boolval(preg_match('/(\d)\1{' . (self::CPF_LENGTH - 1) . '}/', $docNumber));
    }

    private function validateCpfDigit(string $docNumber, int $position): bool
    {
        $sum = 0;

        for ($index = 0; $index < $position; ++$index) {
            $sum += $docNumber[$index] * (($position + 1) - $index);
        }

        $digit = ((10 * $sum) % 11) % 10;

        return $docNumber[$position] == $digit;
    }
}
