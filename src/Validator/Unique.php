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

class Unique extends AbstractValidator implements ValidatorInterface
{
    protected const ERROR_VALUE_ALREADY_USED = 'The given value for %s is already in use.';

    protected const ERROR_INVALID_ENTITY_OBJECT = 'The given value is not a valid Entity object.';

    private string $index;

    private string $field;

    /**
     * Validates the given value by checking its resolved ID and ensuring its uniqueness.
     *
     * @param mixed $value the value to be validated
     * @return bool returns true if the value is valid, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }
        $value = $this->resolveValueId($value);

        if (! $value) {
            return false;
        }

        if (! $this->isValueUnique($value)) {
            $this->addError('ERROR_VALUE_ALREADY_USED', self::ERROR_VALUE_ALREADY_USED, [$this->field]);
            return false;
        }

        return true;
    }

    public function setIndex(string $index): Unique
    {
        $this->index = $index;
        return $this;
    }

    public function setField(string $field): Unique
    {
        $this->field = $field;
        return $this;
    }

    /**
     * Checks if the given value is unique within the index by querying the database.
     *
     * @param mixed $value The value to be checked. It can be a scalar value or an array of values.
     * @return bool returns true if the value is unique, otherwise false
     */
    private function isValueUnique(mixed $value): bool
    {
        return $this->queryBuilder
            ->from($this->index)
            ->where($this->field, '=', $value)
            ->count() === 0;
    }

    /**
     * Resolves and returns the ID of the given value. If the value is an object, it checks for the existence
     * of a `getId` method to retrieve the ID. Otherwise, it directly returns the value itself.
     *
     * @param mixed $value The value to be processed. It can be an object with a `getId` method or a scalar.
     * @return mixed returns the ID of the object if it has a `getId` method, the original scalar value, or null if the object is invalid
     */
    private function resolveValueId(mixed $value): mixed
    {
        if (is_object($value) && ! method_exists($value, 'getId')) {
            $this->addError('ERROR_INVALID_ENTITY_OBJECT', self::ERROR_INVALID_ENTITY_OBJECT);
            return null;
        }

        return is_object($value) ? $value->getId() : $value;
    }
}
