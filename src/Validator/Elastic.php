<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Elastic extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected string $index, protected string $field, protected QueryBuilder $queryBuilder)
    {
    }

    /**
     * Validates whether the given value exists in the specified field of the index.
     *
     * @param string $value The value to be validated.
     * @return bool Returns true if the value exists, false otherwise.
     */
    public function validate(mixed $value): bool
    {
        return $this->queryBuilder
                ->from($this->index)
                ->where($this->field, $value)
                ->count() > 0;
    }
}