<?php

namespace Jot\HfValidator;

use Hyperf\Stringable\Str;
use function Hyperf\Support\make;

class ValidatorChain
{

    private static array $targets = [];

    static public function getValidator(object $validator): object
    {
        $validatorClass = str_replace('Annotation', 'Validator', get_class($validator));
        $validatorInstance = make($validatorClass);
        foreach ($validator->toArray() as $property => $value) {
            $method = 'set' . ucfirst(Str::camel($property));
            if (method_exists($validatorInstance, $method)) {
                $validatorInstance->$method($value);
            }
        }
        return $validatorInstance;
    }

    static public function addTarget(string $target, string $property, ?object $validator): void
    {
        self::$targets[$target][$property][] = self::getValidator($validator);
    }

    static public function list(string $target): array
    {
        return self::$targets[$target] ?? [];
    }

}