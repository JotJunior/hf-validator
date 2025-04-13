<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;

use function Hyperf\Translation\__;

class Regex extends AbstractValidator implements ValidatorInterface
{
    private string $pattern;

    /**
     * Validates the given value against a predefined pattern.
     *
     * @param mixed $value the value to be validated
     * @return bool returns true if the value matches the pattern, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (@preg_match($this->pattern, '') !== false) {
            $this->errors[] = __('hf-validator.error_invalid_pattern');
        }

        $isValid = preg_match($this->pattern, $value) > 0;

        if (! $isValid) {
            $this->errors[] = __('hf-validator.error_pattern_mismatch');
        }

        return $isValid;
    }

    public function setPattern(string $pattern): Regex
    {
        $this->pattern = $pattern;
        return $this;
    }
}
