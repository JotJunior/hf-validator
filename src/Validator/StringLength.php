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

class StringLength extends AbstractValidator implements ValidatorInterface
{
    private ?int $min = null;

    private ?int $max = null;

    /**
     * Validates the given value by ensuring it meets the string length required criteria.
     *
     * @param mixed $value the value to be validated
     *
     * @return bool returns true if the validation passes, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! $this->isStringType($value)) {
            return false;
        }

        $valueLength = $this->calculateLength($value);

        if (! $this->validateMinLength($valueLength)) {
            return false;
        }

        if (! $this->validateMaxLength($valueLength)) {
            return false;
        }

        return true;
    }

    public function setMin(int $min): StringLength
    {
        $this->min = $min;
        return $this;
    }

    public function setMax(int $max): StringLength
    {
        $this->max = $max;
        return $this;
    }

    private function isStringType(mixed $value): bool
    {
        if (! is_string($value)) {
            $this->errors[] = __('hf-validator.error_must_be_string');
            return false;
        }
        return true;
    }

    private function calculateLength(string $value): int
    {
        return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
    }

    private function validateMinLength(int $valueLength): bool
    {
        if ($this->min !== null && $valueLength < $this->min) {
            $this->errors[] = __('hf-validator.error_min_length', ['min' => $this->min]);
            return false;
        }
        return true;
    }

    private function validateMaxLength(int $valueLength): bool
    {
        if ($this->max !== null && $valueLength > $this->max) {
            $this->errors[] = __('hf-validator.error_max_length', ['max' => $this->max]);
            return false;
        }
        return true;
    }
}
