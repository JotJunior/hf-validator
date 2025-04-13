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

use DateTimeInterface;
use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;

use function Hyperf\Translation\__;

class Gt extends AbstractValidator implements ValidatorInterface
{
    private DateTimeInterface|float $value;

    /**
     * Validate the provided value to ensure it matches the expected type and is greater than the stored value.
     *
     * @param mixed $value the value to be validated
     * @return bool returns true if valid, false otherwise
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! $this->isValidType($value)) {
            return false;
        }

        if ($value <= $this->value) {
            $this->errors[] = __('hf-validator.error_must_be_greater_than', ['min' => $value]);
            return false;
        }

        return true;
    }

    public function setValue(DateTimeInterface|float $value): Gt
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Verifies if the type of the provided value is valid. Adds relevant error messages when invalid.
     *
     * @param mixed $value the value to check
     * @return bool returns true if the value type matches the expected type
     */
    protected function isValidType(mixed $value): bool
    {
        if ($this->value instanceof DateTimeInterface && is_numeric($value)) {
            $this->errors[] = __('hf-validator.error_must_be_datetime');
            return false;
        }

        if (is_numeric($this->value) && $value instanceof DateTimeInterface) {
            $this->errors[] = __('hf-validator.error_must_be_numeric');
            return false;
        }

        return true;
    }
}
