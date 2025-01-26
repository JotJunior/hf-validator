<?php

namespace Jot\HfValidator;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;
use Jot\HfElastic\QueryBuilder;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Elastic extends AbstractAnnotation
{

    protected QueryBuilder $queryBuilder;

    public function __construct(protected string $index, protected string $field, protected string $value)
    {

    }

    public function validate(): bool
    {
        return $this->queryBuilder
                ->from($this->index)
                ->where($this->field, $this->value)
                ->count() > 0;
    }
}