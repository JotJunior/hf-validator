<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Elastic extends AbstractAttribute implements ValidatorInterface
{

    protected QueryBuilder $queryBuilder;

    /**
     * Validates a value against given criteria by querying a database or dataset.
     *
     * @param string $value The value to be validated.
     * @param array $options An associative array of options where:
     *                        - 'index' represents the dataset or table to query.
     *                        - 'field' specifies the field or column to match the value against.
     * @return bool Returns true if the value is found in the specified field of the dataset, otherwise false.
     */
    public function validate(string $value, array $options = []): bool
    {
        return $this->queryBuilder
                ->from($options['index'])
                ->where($options['field'], $value)
                ->count() > 0;
    }
}