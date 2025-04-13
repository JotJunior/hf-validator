<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;

use function Hyperf\Translation\__;

class Required extends AbstractValidator implements ValidatorInterface
{
    /**
     * Validates the provided value based on specific conditions.
     *
     * @param mixed $value the value to be validated
     * @return bool returns true if the value is valid, false otherwise
     */
    public function validate(mixed $value): bool
    {
        if ($this->shouldAddError($value)) {
            $this->errors[] = __('hf-validator.error_field_is_required', ['field' => $this->property]);
            return false;
        }

        return true;
    }

    private function shouldAddError(mixed $value): bool
    {
        return $this->{$this->context} && ($this->isNull($value) || $this->isEmptyString($value) || $this->isInvalidObject($value));
    }

    /**
     * Checks if the given value is null.
     *
     * @param mixed $value the value to be checked
     * @return bool returns true if the value is null, false otherwise
     */
    private function isNull(mixed $value): bool
    {
        return is_null($value);
    }

    /**
     * Checks if the given value is an empty string.
     *
     * @param mixed $value the value to be checked
     * @return bool returns true if the value is a string and is empty after trimming, false otherwise
     */
    private function isEmptyString(mixed $value): bool
    {
        return is_string($value) && trim($value) === '';
    }

    /**
     * Checks if the provided value is an invalid object based on specific criteria.
     *
     * @param mixed $value the value to be checked
     * @return bool Returns true if the value is an object that has a `getid` method and its `getid` result is empty. Returns false otherwise.
     */
    private function isInvalidObject(mixed $value): bool
    {
        return is_object($value) && method_exists($value, 'getId') && empty($value->getId());
    }
}
