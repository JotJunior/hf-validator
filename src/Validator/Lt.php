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
use Jot\HfValidator\ValidatorInterface;

use function Hyperf\Translation\__;

class Lt extends Gt implements ValidatorInterface
{
    private DateTimeInterface|float $value;

    /**
     * Validates the provided value based on type and a minimum threshold.
     *
     * @param mixed $value the value to be validated
     * @return bool returns true if the value meets the validation criteria; otherwise, false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! $this->isValidType($value)) {
            return false;
        }

        if ($value >= $this->value) {
            $this->errors[] = __('hf-validator.error_must_be_less_than', ['max' => $value]);
            return false;
        }

        return true;
    }

    public function setValue(DateTimeInterface|float $value): Lt
    {
        $this->value = $value;
        return $this;
    }

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
