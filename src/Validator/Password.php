<?php

declare(strict_types=1);
/**
 * This file is part of Gekom APIv2.
 *
 * @document https://github.com/JotJunior/gekom
 * @author   Joao Zanon <jot@jot.con.br>
 * @link     https://gekom.com.br
 * @license  Private
 */

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;

use function Hyperf\Translation\__;

class Password extends AbstractValidator implements ValidatorInterface
{
    private bool $requireLower = true;

    private bool $requireUpper = true;

    private bool $requireNumber = true;

    private bool $requireSpecial = true;

    private string $special = '!@#$%&*_';

    private int $minLength = 8;

    private int $maxLength = 20;

    public function validate($value): bool
    {
        if (empty($value)) {
            return true;
        }

        $isValid = preg_match($this->createPattern(), $value) > 0;
        if (! $isValid) {
            $this->addValidationMessage();
        }
        return $isValid;
    }

    public function setRequireLower(bool $requireLower): Password
    {
        $this->requireLower = $requireLower;
        return $this;
    }

    public function setRequireUpper(bool $requireUpper): Password
    {
        $this->requireUpper = $requireUpper;
        return $this;
    }

    public function setRequireNumber(bool $requireNumber): Password
    {
        $this->requireNumber = $requireNumber;
        return $this;
    }

    public function setRequireSpecial(bool $requireSpecial): Password
    {
        $this->requireSpecial = $requireSpecial;
        return $this;
    }

    public function setSpecial(string $special): Password
    {
        $this->special = $special;
        return $this;
    }

    public function setMinLength(int $minLength): Password
    {
        $this->minLength = $minLength;
        return $this;
    }

    public function setMaxLength(int $maxLength): Password
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    protected function createPattern(): string
    {
        $pattern = [''];
        if ($this->requireLower) {
            $pattern['lower'] = '(?=.*[a-z])';
        }
        if ($this->requireUpper) {
            $pattern['upper'] = '(?=.*[A-Z])';
        }
        if ($this->requireNumber) {
            $pattern['number'] = '(?=.*\d)';
        }
        if ($this->requireSpecial) {
            $pattern['special'] = sprintf('(?=.*[%s])', $this->special);
        }
        $pattern['minLength'] = sprintf('.{%d,%d}', $this->minLength, $this->maxLength);

        return sprintf('/^%s$/', implode('', $pattern));
    }

    protected function addValidationMessage(): void
    {
        $conditions = $this->getIndividualConditions();
        $this->errors[] = __('hf-validator.error_invalid_password', ['conditions' => implode(', ', $conditions)]);
    }

    private function getIndividualConditions(): array
    {
        $conditions = [];

        $conditions[] = __('hf-validator.error_length', ['min' => $this->minLength, 'max' => $this->maxLength]);

        if ($this->requireLower) {
            $conditions[] = __('hf-validator.error_match_lower');
        }
        if ($this->requireUpper) {
            $conditions[] = __('hf-validator.error_match_upper');
        }
        if ($this->requireNumber) {
            $conditions[] = __('hf-validator.error_match_number');
        }
        if ($this->requireSpecial) {
            $conditions[] = __('hf-validator.error_match_special');
        }

        return $conditions;
    }
}
