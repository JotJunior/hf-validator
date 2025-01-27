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
        $isValid = $this->queryBuilder
                ->from($this->index)
                ->where($this->field, $value)
                ->count() === 0;

        if (!$isValid) {
            $this->errors[] = 'The given value is already in use.';
        }

        return $isValid;
    }
}