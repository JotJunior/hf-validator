<?php

namespace Jot\HfValidator;

use ReflectionClass;
use ReflectionMethod;
use RuntimeException;

class Validator
{
    public static function validate(object $entity, string $method, $value)
    {
        $reflection = new ReflectionClass($entity);

        $methodReflection = $reflection->getMethod($method);
        $attributes = $methodReflection->getAttributes();

        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();
            if (method_exists($instance, 'validate') && !$instance->validate($value)) {
                throw new RuntimeException("Validation failed for $method.");
            }
        }
    }
}