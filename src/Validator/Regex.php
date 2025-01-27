<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Regex extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected string $pattern)
    {
    }


    /**
     * Validates the given value against a predefined pattern.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value matches the pattern, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        return preg_match($this->pattern, $value) === 1;
    }
}