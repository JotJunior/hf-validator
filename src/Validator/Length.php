<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Length extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected ?int $min = null, protected ?int $max = null)
    {
    }

    /**
     * Validates the given value by ensuring it meets the string length required criteria.
     *
     * @param mixed $value The value to be validated.
     *
     * @return bool Returns true if the validation passes, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        $this->validateStringType($value);

        $valueLength = $this->calculateLength($value);

        $this->validateMinLength($valueLength);
        $this->validateMaxLength($valueLength);

        return empty($this->errors);
    }

    private function validateStringType(mixed $value): void
    {
        if (!is_string($value)) {
            $this->errors[] = 'Value must be a string';
        }
    }

    private function calculateLength(string $value): int
    {
        return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
    }

    private function validateMinLength(int $valueLength): void
    {
        if ($this->min !== null && $valueLength < $this->min) {
            $this->errors[] = "Value must be at least {$this->min} characters long";
        }
    }

    private function validateMaxLength(int $valueLength): void
    {
        if ($this->max !== null && $valueLength > $this->max) {
            $this->errors[] = "Value must be at most {$this->max} characters long";
        }
    }

}