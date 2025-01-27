<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Enum extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected array $values)
    {
    }


    /**
     * Validates if the provided value exists within the predefined values.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value exists within the predefined values, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        return in_array($value, $this->values);
    }
}