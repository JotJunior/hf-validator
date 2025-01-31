<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class Range extends AbstractValidator implements ValidatorInterface
{

    public const ERROR_OUT_OF_RANGE = 'The value must be between %s and %s.';
    private float|\DateTimeInterface $min;
    private float|\DateTimeInterface $max;

    /**
     * Validates whether the provided value is within the defined minimum and maximum range.
     *
     * @param mixed $value The value to validate.
     * @return bool True if the value is within the range, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (!$this->isValidType($value)) {
            return false;
        }

        $isValid = $value >= $this->min && $value <= $this->max;

        if (!$isValid) {
            $this->addError('ERROR_OUT_OF_RANGE', self::ERROR_OUT_OF_RANGE, [$this->min, $this->max]);
        }

        return $isValid;

    }

    /**
     * Verifies if the type of the provided value is valid. Adds relevant error messages when invalid.
     *
     * @param mixed $value The value to check.
     * @return bool Returns true if the value type matches the expected type.
     */
    protected function isValidType(mixed $value): bool
    {
        if (is_numeric($value) && ($this->min instanceof \DateTimeInterface || $this->max instanceof \DateTimeInterface)) {
            $this->addError('ERROR_MUST_BE_DATETIME', self::ERROR_MUST_BE_DATETIME, [$this->min, $this->max]);
            return false;
        }

        if ($value instanceof \DateTimeInterface && (is_numeric($this->min) || is_numeric($this->max))) {
            $this->addError('ERROR_MUST_BE_NUMERIC', self::ERROR_MUST_BE_NUMERIC, [$this->min, $this->max]);
            return false;
        }

        return true;
    }

    public function setMin(float|\DateTimeInterface $min): Range
    {
        $this->min = $min;
        return $this;
    }

    public function setMax(float|\DateTimeInterface $max): Range
    {
        $this->max = $max;
        return $this;
    }


}