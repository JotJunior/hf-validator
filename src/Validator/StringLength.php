<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class StringLength extends AbstractValidator implements ValidatorInterface
{

    public const ERROR_MIN_LENGTH = 'Value must be at least %s characters long';
    public const ERROR_MAX_LENGTH = 'Value must be at most %s characters long';
    private ?int $min = null;
    private ?int $max = null;

    /**
     * Validates the given value by ensuring it meets the string length required criteria.
     *
     * @param mixed $value The value to be validated.
     *
     * @return bool Returns true if the validation passes, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (!$this->isStringType($value)) {
            return false;
        }

        $valueLength = $this->calculateLength($value);

        if (!$this->validateMinLength($valueLength)) {
            return false;
        }

        if (!$this->validateMaxLength($valueLength)) {
            return false;
        }

        return true;
    }

    private function isStringType(mixed $value): bool
    {
        if (!is_string($value)) {
            $this->addError('ERROR_MUST_BE_STRING', self::ERROR_MUST_BE_STRING);
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
            $this->addError('ERROR_MIN_LENGTH', self::ERROR_MIN_LENGTH, [$this->min]);
            return false;
        }
        return true;
    }

    private function validateMaxLength(int $valueLength): bool
    {
        if ($this->max !== null && $valueLength > $this->max) {
            $this->addError('ERROR_MAX_LENGTH', self::ERROR_MAX_LENGTH, [$this->max]);
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


}