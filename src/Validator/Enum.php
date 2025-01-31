<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class Enum extends AbstractValidator implements ValidatorInterface
{

    public const ERROR_VALUE_OUT_OF_PREDEFINED_LIST = 'The value must be one of the following: %s';
    private array $values;


    /**
     * Validates if the provided value exists within the predefined values.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value exists within the predefined values, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (!in_array($value, $this->values)) {
            $this->addError('ERROR_VALUE_OUT_OF_PREDEFINED_LIST', self::ERROR_VALUE_OUT_OF_PREDEFINED_LIST, [implode(', ', $this->values)]);
            return false;
        }

        return true;
    }

    public function setValues(array $values): Enum
    {
        $this->values = $values;
        return $this;
    }


}