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

use DateTimeInterface;
use Jot\HfValidator\ValidatorInterface;

class Gte extends Gt implements ValidatorInterface
{
    public const ERROR_MESSAGE = 'The value must be greater than or equal to %s.';

    private DateTimeInterface|float $value;

    /**
     * Validates the provided value based on type and a minimum threshold.
     *
     * @param mixed $value the value to be validated
     * @return bool returns true if the value meets the validation criteria; otherwise, false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! $this->isValidType($value)) {
            return false;
        }

        if ($value < $this->value) {
            $this->addError('ERROR_MESSAGE', self::ERROR_MESSAGE, [$this->value]);
            return false;
        }

        return true;
    }

    public function setValue(DateTimeInterface|float $value): Gte
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Verifies if the type of the provided value is valid. Adds relevant error messages when invalid.
     *
     * @param mixed $value the value to check
     * @return bool returns true if the value type matches the expected type
     */
    protected function isValidType(mixed $value): bool
    {
        if ($this->value instanceof DateTimeInterface && is_numeric($value)) {
            $this->addError('ERROR_MUST_BE_DATETIME', self::ERROR_MUST_BE_DATETIME, [$this->value]);
            return false;
        }

        if (is_numeric($this->value) && $value instanceof DateTimeInterface) {
            $this->addError('ERROR_MUST_BE_NUMERIC', self::ERROR_MUST_BE_NUMERIC, [$this->value]);
            return false;
        }

        return true;
    }
}
