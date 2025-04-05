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

class Password extends AbstractValidator implements ValidatorInterface
{
    public const ERROR_INVALID_PASSWORD = 'Your password must have at least %s and be between %s and %s characters long.';

    public const ERROR_MATCH_LOWER = 'one lower case letter';

    public const ERROR_MATCH_UPPER = 'one upper case letter';

    public const ERROR_MATCH_NUMBER = 'one number';

    public const ERROR_MATCH_SPECIAL = 'one special character';

    public const ERROR_LENGTH = 'between %s and %s characters long';

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

    protected function addValidationMessage(): void
    {
        $conditions = $this->getIndividualConditions();
        $this->addError('ERROR_INVALID_PASSWORD', self::ERROR_INVALID_PASSWORD, $conditions);
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

    private function getIndividualConditions(): array
    {
        $conditions = [];

        if ($this->requireLower) {
            $conditions[] = $this->customErrorMessages['ERROR_MATCH_LOWER'] ?? self::ERROR_MATCH_LOWER;
        }
        if ($this->requireUpper) {
            $conditions[] = $this->customErrorMessages['ERROR_MATCH_UPPER'] ?? self::ERROR_MATCH_UPPER;
        }
        if ($this->requireNumber) {
            $conditions[] = $this->customErrorMessages['ERROR_MATCH_NUMBER'] ?? self::ERROR_MATCH_NUMBER;
        }
        if ($this->requireSpecial) {
            $conditions[] = $this->customErrorMessages['ERROR_MATCH_SPECIAL'] ?? self::ERROR_MATCH_SPECIAL;
        }
        $conditions[] = sprintf($this->customErrorMessages['ERROR_LENGTH'] ?? self::ERROR_LENGTH, $this->minLength, $this->maxLength);

        return $conditions;
    }
}
