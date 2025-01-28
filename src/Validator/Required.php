<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Required extends AbstractAttribute implements ValidatorInterface
{
    private const ERROR_MESSAGE = 'This field is required.';

    /**
     * Validates the provided value based on specific conditions.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value is valid, false otherwise.
     */
    public function validate(mixed $value): bool
    {
        if ($this->isNull($value) || $this->isEmptyString($value) || $this->isInvalidObject($value)) {
            $this->addError(self::ERROR_MESSAGE);
            return false;
        }

        return true;
    }

    /**
     * Checks if the given value is null.
     *
     * @param mixed $value The value to be checked.
     * @return bool Returns true if the value is null, false otherwise.
     */
    private function isNull(mixed $value): bool
    {
        return is_null($value);
    }

    /**
     * Checks if the given value is an empty string.
     *
     * @param mixed $value The value to be checked.
     * @return bool Returns true if the value is a string and is empty after trimming, false otherwise.
     */
    private function isEmptyString(mixed $value): bool
    {
        return is_string($value) && trim($value) === '';
    }

    /**
     * Checks if the provided value is an invalid object based on specific criteria.
     *
     * @param mixed $value The value to be checked.
     * @return bool Returns true if the value is an object that has a `getid` method and its `getid` result is empty. Returns false otherwise.
     */
    private function isInvalidObject(mixed $value): bool
    {
        return is_object($value) && method_exists($value, 'getid') && empty($value->getid());
    }

    /**
     * Adds an error message to the error list.
     *
     * @param string $message The error message to add.
     * @return void
     */
    private function addError(string $message): void
    {
        $this->errors[] = $message;
    }
}
