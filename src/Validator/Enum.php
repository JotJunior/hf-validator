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

class Enum extends AbstractValidator implements ValidatorInterface
{
    private array $values;

    /**
     * Validates if the provided value exists within the predefined values.
     *
     * @param mixed $value the value to be validated
     * @return bool returns true if the value exists within the predefined values, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! in_array($value, $this->values)) {
            $this->errors[] = __('hf-validator.error_value_out_of_predefined_list', ['list' => implode(', ', $this->values)]);
            return false;
        }

        return true;
    }

    public function setValues(array $values): Enum
    {
        $this->values = $values;
        return $this;
    }
}
