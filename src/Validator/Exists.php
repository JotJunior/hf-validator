<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class Exists extends AbstractValidator implements ValidatorInterface
{

    public const ERROR_INVALID_ENTITY = 'The given value is not a valid Entity object.';
    public const ERROR_VALUE_DOES_NOT_EXIST = 'The given value does not exist in the specified index and field.';
    private string $index;
    private string $field;

    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if ($this->isEntityInvalid($value)) {
            $this->addError('ERROR_INVALID_ENTITY', self::ERROR_INVALID_ENTITY);
            return false;
        }

        $value = $this->extractEntityId($value);

        if (!$this->doesValueExist($value)) {
            $this->addError('ERROR_VALUE_DOES_NOT_EXIST', self::ERROR_VALUE_DOES_NOT_EXIST);
            return false;
        }

        return true;
    }

    private function isEntityInvalid(mixed $value): bool
    {
        return is_object($value) && !method_exists($value, 'getId');
    }

    private function extractEntityId(mixed $value): mixed
    {
        return is_object($value) && method_exists($value, 'getId') ? $value->getId() : $value;
    }

    private function doesValueExist(mixed $value): bool
    {
        return $this->queryBuilder
                ->from($this->index)
                ->where($this->field, '=', $value)
                ->count() > 0;
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


}

