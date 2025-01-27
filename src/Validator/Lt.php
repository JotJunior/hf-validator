<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Lt extends Gt implements ValidatorInterface
{

    /**
     * Validates the provided value based on type and a minimum threshold.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value meets the validation criteria; otherwise, false.
     */
    public function validate(mixed $value): bool
    {

        return $this->validateTypes($value) && $value < $this->value;

    }

}