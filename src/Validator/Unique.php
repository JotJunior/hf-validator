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
    protected const ERROR_MESSAGE = 'The given value for %s is already in use.';

    protected ?QueryBuilder $queryBuilder;

    public function __construct(protected string $index, protected string $field)
    {
    }

    public function setContainer(?ContainerInterface $container): void
    {
        $this->queryBuilder = $container->get(QueryBuilder::class);
    }

    /**
     * Validates the given value by checking its resolved ID and ensuring its uniqueness.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value is valid, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        $value = $this->resolveValueId($value);

        if (!$value) {
            return false;
        }

        if (!$this->isValueUnique($value)) {
            $this->addErrorMessage(sprintf(self::ERROR_MESSAGE, $this->field));
            return false;
        }

        return true;
    }

    /**
     * Checks if the given value is unique within the index by querying the database.
     *
     * @param mixed $value The value to be checked. It can be a scalar value or an array of values.
     * @return bool Returns true if the value is unique, otherwise false.
     */
    private function isValueUnique(mixed $value): bool
    {
        $query = $this->queryBuilder->from($this->index);

        if (is_array($value)) {
            foreach ($value as $fieldValue) {
                $query->orWhere($this->field, '=', $fieldValue);
            }
        } else {
            $query->where($this->field, '=', $value);
        }

        $valueCount = $query->count();

        return $valueCount === 0;
    }

    /**
     * Adds an error message to the list of errors.
     *
     * @param string $message The error message to be added.
     * @return void
     */
    private function addErrorMessage(string $message): void
    {
        $this->errors[] = $message;
    }

    /**
     * Resolves and returns the ID of the given value. If the value is an object, it checks for the existence
     * of a `getId` method to retrieve the ID. Otherwise, it directly returns the value itself.
     *
     * @param mixed $value The value to be processed. It can be an object with a `getId` method or a scalar.
     * @return mixed Returns the ID of the object if it has a `getId` method, the original scalar value, or null if the object is invalid.
     */
    private function resolveValueId(mixed $value): mixed
    {
        if (is_object($value) && !method_exists($value, 'getId')) {
            $this->addErrorMessage('The given value is not a valid Entity object.');
            return null;
        }

        return is_object($value) ? $value->getId() : $value;
    }

}