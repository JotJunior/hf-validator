<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidatorTest\Validator;

use ReflectionProperty;

trait ValidatorTrait
{
    protected function getRelatedClassFromAttributes(string $class, string $attribute, string $property): ?string
    {
        $reflection = new ReflectionProperty($class, $property);
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
