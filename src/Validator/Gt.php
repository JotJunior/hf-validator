<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class Gt extends AbstractValidator implements ValidatorInterface
{

    public const ERROR_MESSAGE = 'The value must be greater than %s.';

    private float|\DateTimeInterface $value;

    /**
     * Validate the provided value to ensure it matches the expected type and is greater than the stored value.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if valid, false otherwise.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (!$this->isValidType($value)) {
            return false;
        }

        if ($value <= $this->value) {
            $this->addError('ERROR_MESSAGE', self::ERROR_MESSAGE, [$this->value]);
            return false;
        }

        return true;
    }

    /**
     * Verifies if the type of the provided value is valid. Adds relevant error messages when invalid.
     *
     * @param mixed $value The value to check.
     * @return bool Returns true if the value type matches the expected type.
     */
    protected function isValidType(mixed $value): bool
    {
        if ($this->value instanceof \DateTimeInterface && is_numeric($value)) {
            $this->addError('ERROR_MUST_BE_DATETIME', self::ERROR_MUST_BE_DATETIME, [$this->value]);
            return false;
        }

        if (is_numeric($this->value) && $value instanceof \DateTimeInterface) {
            $this->addError('ERROR_MUST_BE_NUMERIC', self::ERROR_MUST_BE_NUMERIC, [$this->value]);
            return false;
        }

        return true;
    }

    public function setValue(float|\DateTimeInterface $value): Gt
    {
        $this->value = $value;
        return $this;
    }


}