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
use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;

class Range extends AbstractValidator implements ValidatorInterface
{
    public const ERROR_OUT_OF_RANGE = 'The value must be between %s and %s.';

    private DateTimeInterface|float $min;

    private DateTimeInterface|float $max;

    /**
     * Validates whether the provided value is within the defined minimum and maximum range.
     *
     * @param mixed $value the value to validate
     * @return bool true if the value is within the range, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! $this->isValidType($value)) {
            return false;
        }

        $isValid = $value >= $this->min && $value <= $this->max;

        if (! $isValid) {
            $this->addError('ERROR_OUT_OF_RANGE', self::ERROR_OUT_OF_RANGE, [$this->min, $this->max]);
        }

        return $isValid;
    }

    public function setMin(DateTimeInterface|float $min): Range
    {
        $this->min = $min;
        return $this;
    }

    public function setMax(DateTimeInterface|float $max): Range
    {
        $this->max = $max;
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
        if (is_numeric($value) && ($this->min instanceof DateTimeInterface || $this->max instanceof DateTimeInterface)) {
            $this->addError('ERROR_MUST_BE_DATETIME', self::ERROR_MUST_BE_DATETIME, [$this->min, $this->max]);
            return false;
        }

        if ($value instanceof DateTimeInterface && (is_numeric($this->min) || is_numeric($this->max))) {
            $this->addError('ERROR_MUST_BE_NUMERIC', self::ERROR_MUST_BE_NUMERIC, [$this->min, $this->max]);
            return false;
        }

        return true;
    }
}
