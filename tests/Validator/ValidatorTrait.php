<?php

namespace Jot\HfValidatorTest\Validator;

use Hyperf\Di\Annotation\AnnotationInterface;
use Jot\HfElastic\QueryBuilder;
use stdClass;

trait ValidatorTrait
{
    protected function getRelatedClassFromAttributes(string $class, string $attribute, string $property): ?string
    {
        $reflection = new \ReflectionProperty($class, $property);
        $attributes = $reflection->getAttributes($attribute);

        foreach ($attributes as $attribute) {
            $annotation = $attribute->newInstance();
            if (isset($annotation->x['php_type']) && is_string($annotation->x['php_type'])) {
                return $annotation->x['php_type'];
            }
        }

        return null;
    }

}