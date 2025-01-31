<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\ValidatorInterface;


class Lt extends Gt implements ValidatorInterface
{

    public const ERROR_MESSAGE = 'The value must be lower than %s';
    private float|\DateTimeInterface $value;

    /**
     * Validates the provided value based on type and a minimum threshold.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value meets the validation criteria; otherwise, false.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (!$this->isValidType($value)) {
            return false;
        }

        if ($value >= $this->value) {
            $this->addError('ERROR_MESSAGE', self::ERROR_MESSAGE, [$this->value]);
            return false;
        }

        return true;
    }

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

    public function setValue(float|\DateTimeInterface $value): Lt
    {
        $this->value = $value;
        return $this;
    }


}