<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Range extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected float $min, protected float $max)
    {
    }

    /**
     * Validates whether the provided value is within the defined minimum and maximum range.
     *
     * @param mixed $value The value to validate.
     * @return bool True if the value is within the range, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (!is_numeric($value)) {
            $this->errors[] = 'Value must be numeric';
            return false;
        }
        return $value >= $this->min && $value <= $this->max;
    }
}