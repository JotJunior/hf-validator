<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Gt extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected \DateTime|float $value)
    {
    }


    /**
     * Validates the given value based on the type of the object's value.
     *
     * @param mixed $value The value to be validated. Can be numeric or a DateTime object.
     * @return bool Returns true if the validation passes; false otherwise.
     */
    public function validate(mixed $value): bool
    {

        return $this->validateTypes($value) && $value > $this->value;

    }

    /**
     * Validates the type of the given value against the type of the object's value.
     *
     * @param mixed $value The value to be validated. Can be a numeric value or a DateTime object.
     * @return bool Returns true if the value's type matches the expected type; false otherwise.
     */
    protected function validateTypes(mixed $value): bool
    {
        if ($this->value instanceof \DateTime && is_numeric($value)) {
            $this->errors[] = 'The value must be a DateTime object.';
            return false;
        }

        if (is_numeric($this->value) && $value instanceof \DateTime) {
            $this->errors[] = 'The value must be a numeric value.';
            return false;
        }

        return true;
    }
}