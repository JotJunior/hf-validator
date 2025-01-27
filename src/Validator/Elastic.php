<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Elastic extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected string $index, protected string $field, protected ?QueryBuilder $queryBuilder = null)
    {
    }


    /**
     * Validates the given value against a specific index and field in the query builder.
     *
     * @param mixed $value The value to validate, which can be an object or any other type.
     * @return bool Returns true if the value exists in the specified index and field, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (is_object($value) && !method_exists($value, 'getId')) {
            $this->errors[] = 'The given value is not a valid Entity object.';
            return false;
        }
        if (is_object($value) && method_exists($value, 'getId')) {
            $value = $value->getId();
        }
        return $this->queryBuilder
                ->from($this->index)
                ->where($this->field, $value)
                ->count() > 0;
    }
}