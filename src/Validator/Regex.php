<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class Regex extends AbstractValidator implements ValidatorInterface
{

    public const ERROR_INVALID_REGEX = 'Invalid regex pattern.';
    public const ERROR_INVALID_VALUE = 'Invalid value. Check if your string matches the following pattern:';
    private string $pattern;

    /**
     * Validates the given value against a predefined pattern.
     *
     * @param mixed $value The value to be validated.
     * @return bool Returns true if the value matches the pattern, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (@preg_match($this->pattern, '') !== false) {
            $this->addError('ERROR_INVALID_REGEX', self::ERROR_INVALID_REGEX, [$this->pattern]);
        }

        $isValid = preg_match($this->pattern, $value) > 0;

        if (!$isValid) {
            $this->addError('ERROR_INVALID_VALUE', self::ERROR_INVALID_VALUE, [$this->pattern]);
        }

        return $isValid;
    }

    public function setPattern(string $pattern): Regex
    {
        $this->pattern = $pattern;
        return $this;
    }


}