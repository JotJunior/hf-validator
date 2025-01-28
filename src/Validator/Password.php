<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Password extends AbstractAttribute implements ValidatorInterface
{

    protected array $patterns = [];

    public function __construct(
        protected bool  $requireLower = true,
        protected bool  $requireUpper = true,
        protected bool  $requireNumber = true,
        protected bool  $requireSpecial = true,
        protected int   $minLength = 8,
        protected array $special = ['!', '@', '#', '$', '%', '&', '*', '(', ')'],
    )
    {
        if ($this->requireLower) {
            $this->patterns['lower'] = '(?=.*[a-z])';
        }
        if ($this->requireUpper) {
            $this->patterns['upper'] = '(?=.*[A-Z])';
        }
        if ($this->requireNumber) {
            $this->patterns['number'] = '(?=.*\d)';
        }
        if ($this->requireSpecial) {
            $this->patterns['special'] = sprintf('(?=.*[%s])', implode('', $special));
        }
        $this->patterns['minLength'] = sprintf('.{%d,}', $minLength);

    }

    public function validate($value): bool
    {
        $pattern = sprintf('/^%s$/', implode('', $this->patterns));
        $isValid = preg_match($pattern, $value) > 0;
        if (!$isValid) {
            $this->errors[] = $this->getValidationMessage();
        }
        return $isValid;
    }

    protected function getValidationMessage(): string
    {
        $conditions = $this->getIndividualConditions();
        $message = 'Your password must have at least ';
        if (count($conditions) > 1) {
            $message .= implode(', ', $conditions);
            $message .= ' and be at least ' . $this->minLength . ' characters long.';
        } else {
            $message .= $this->minLength . ' characters long.';
        }

        return $message;
    }

    private function getIndividualConditions(): array
    {
        $conditions = [];

        if ($this->requireLower) {
            $conditions[] = 'one lower case letter';
        }
        if ($this->requireUpper) {
            $conditions[] = 'one upper case letter';
        }
        if ($this->requireNumber) {
            $conditions[] = 'one number';
        }
        if ($this->requireSpecial) {
            $conditions[] = 'one special character';
        }

        return $conditions;
    }

}