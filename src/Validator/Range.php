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

use function Hyperf\Translation\__;

class Range extends AbstractValidator implements ValidatorInterface
{
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
            $this->errors[] = __('hf-validator.error_value_out_of_range', ['min' => $this->min, 'max' => $this->max]);
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
            $this->errors[] = __('hf-validator.error_must_be_datetime');
            return false;
        }

        if ($value instanceof DateTimeInterface && (is_numeric($this->min) || is_numeric($this->max))) {
            $this->errors[] = __('hf-validator.error_must_be_numeric');
            return false;
        }

        return true;
    }
}
