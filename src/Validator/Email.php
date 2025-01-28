<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Email extends AbstractAttribute implements ValidatorInterface
{

    private const ERROR_INVALID_EMAIL = 'Invalid email';

    public function __construct(protected bool $checkDomain = false)
    {
    }


    public function validate(mixed $value): bool
    {
        if (!is_string($value)) {
            $this->addError(self::ERROR_INVALID_EMAIL);
            return false;
        }

        if ($this->checkDomain && !$this->validateDomain($value)) {
            return false;
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError(self::ERROR_INVALID_EMAIL);
            return false;
        }

        return true;
    }

    private function validateDomain(string $email): bool
    {
        $domain = substr(strrchr($email, "@"), 1);

        if ($domain === false || (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A"))) {
            $this->errors[] = 'Domain not resolvable';
            return false;
        }

        return true;
    }

    private function addError(string $message): void
    {
        $this->errors[] = $message;
    }


}

