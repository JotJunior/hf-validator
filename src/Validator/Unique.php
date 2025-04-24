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

class Unique extends AbstractValidator implements ValidatorInterface
{
    protected const ERROR_VALUE_ALREADY_USED = 'The given value for :field is already in use.';

    protected const ERROR_INVALID_ENTITY_OBJECT = 'The given value is not a valid Entity object.';

    private string $index;

    private string $field;

    private string $level = 'tenant';

    private ?string $tenantId = null;

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
            $this->errors[] = __('hf-validator.error_value_already_used', ['field' => $this->property]);
            return false;
        }

        return true;
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
            $this->errors[] = __('hf-validator.error_invalid_entity_object');
            return null;
        }

        return is_object($value) ? $value->getId() : $value;
    }

    /**
     * Checks if the given value is unique within the index by querying the database.
     *
     * @param mixed $value The value to be checked. It can be a scalar value or an array of values.
     * @return bool returns true if the value is unique, otherwise false
     */
    private function isValueUnique(mixed $value): bool
    {
        $query = $this->queryBuilder
            ->from($this->index)
            ->where($this->field, '=', $value)
            ->andWhere('id', '!=', $this->identifier);
        if ($this->level === 'tenant') {
            $query->andWhere('tenant.id', '=', $this->tenantId);
        }
        return $query->count();
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

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    public function setTenantId(?string $tenantId): void
    {
        $this->tenantId = $tenantId;
    }
}
