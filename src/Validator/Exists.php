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

class Exists extends AbstractValidator implements ValidatorInterface
{
    private string $index;

    private string $field;

    private string $level;

    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if ($this->isEntityInvalid($value)) {
            $this->errors[] = __('hf-validator.error_invalid_entity', ['index' => $this->index, 'value' => (string) $value]);
            return false;
        }

        $value = $this->extractEntityId($value);

        if (! $this->doesValueExist($value)) {
            $this->errors[] = __('hf-validator.error_value_does_not_exist', ['index' => $this->index, 'value' => (string) $value]);
            return false;
        }

        return true;
    }

    public function setIndex(string $index): Exists
    {
        $this->index = $index;
        return $this;
    }

    public function setField(string $field): Exists
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

    private function isEntityInvalid(mixed $value): bool
    {
        return is_object($value) && ! method_exists($value, 'getId');
    }

    private function extractEntityId(mixed $value): mixed
    {
        return is_object($value) && method_exists($value, 'getId') ? $value->getId() : $value;
    }

    private function doesValueExist(mixed $value): bool
    {
        $query = $this->queryBuilder
            ->from($this->index)
            ->where($this->field, $value);
        if ($this->level === 'tenant' && $this->index !== 'tenants') {
            $query->andWhere('tenant.id', $this->tenantId);
        }

        return $query->count() > 0;
    }
}
