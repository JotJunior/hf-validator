<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator;

use Hyperf\Stringable\Str;

use function Hyperf\Support\make;

class ValidatorChain
{
    private static array $targets = [];

    public static function getValidator(object $validator): object
    {
        $validatorClass = str_replace('Annotation', 'Validator', get_class($validator));
        $validatorInstance = make($validatorClass);
        foreach ($validator->toArray() as $property => $value) {
            $method = 'set' . ucfirst(Str::camel($property));
            if (method_exists($validatorInstance, $method)) {
                $validatorInstance->{$method}($value);
            }
        }
        return $validatorInstance;
    }

    public static function addTarget(string $target, string $property, ?object $validator): void
    {
        self::$targets[$target][$property][] = self::getValidator($validator);
    }

    public static function list(string $target): array
    {
        return self::$targets[$target] ?? [];
    }
}
