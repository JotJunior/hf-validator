<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Hyperf\Contract\ContainerInterface;
use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Unique extends AbstractAttribute implements ValidatorInterface
{
    protected ?QueryBuilder $queryBuilder;

    public function __construct(protected string $index, protected string $field)
    {
    }

    public function setContainer(?ContainerInterface $container): void
    {
        $this->queryBuilder = $container->get(QueryBuilder::class);
    }

    public function validate(mixed $value): bool
    {
        $value = $this->extractValueId($value);

        if (!$value) {
            return false;
        }

        $valueCount = $this->queryBuilder
            ->from($this->index)
            ->where($this->field, $value)
            ->count();

        $isUnique = $valueCount === 0;

        if (!$isUnique) {
            $this->errors[] = 'The given value is already in use.';
        }

        return $isUnique;
    }

    private function extractValueId(mixed $value): mixed
    {
        if (is_object($value) && !method_exists($value, 'getId')) {
            $this->errors[] = 'The given value is not a valid Entity object.';
            return null;
        }

        return is_object($value) ? $value->getId() : $value;
    }
}