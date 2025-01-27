<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Regex extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected string $pattern)
    {
    }


    /**
     * Validates the given value against a predefined pattern.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value matches the pattern, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        $result = preg_match($this->pattern, $value) === 1;

        if (!$result) {
            $this->errors = [
                'Invalid value. Check if your string matches the following pattern:',
                ...$this->regexRules($this->pattern),
            ];
        }

        return $result;

    }

    protected function regexRules($regex): array
    {
        $explanation = [];

        $patterns = [
            '/^\^/' => 'Start of the string.',
            '/\.\*/' => 'Any sequence of characters (including empty).',
            '/\[a-z\]/' => 'A lowercase letter (from "a" to "z").',
            '/\[A-Z\]/' => 'An uppercase letter (from "A" to "Z").',
            '/\\\d/' => 'A digit (from "0" to "9").',
            '/\[(.*?)\]/' => 'Allowed set of characters: $1.',
            '/\{(\d+),\}/' => 'At least $1 characters.',
            '/(?=\.\*\[(.*?)\])/' => 'Must contain at least one of the characters: $1.',
            '/\$/' => 'End of the string.',
        ];

        foreach ($patterns as $pattern => $description) {
            if (preg_match($pattern, $regex, $matches)) {
                $explanation[] = isset($matches[1])
                    ? str_replace('$1', $matches[1], $description)
                    : $description;
            }
        }

        return empty($explanation) ? ['Invalid regex pattern.'] : $explanation;
    }
}