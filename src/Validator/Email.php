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

class Email extends AbstractValidator implements ValidatorInterface
{
    private bool $checkDomain = false;

    private array $mostCommonDomainNames = [
        'aol.com',
        'gmail.com',
        'hotmail.com',
        'icloud.com',
        'live.com',
        'mail.com',
        'me.com',
        'outlook.com',
        'yahoo.com',
    ];

    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! is_string($value)) {
            $this->errors[] = __('hf-validator.error_not_a_string');
            return false;
        }

        if ($this->checkDomain && ! $this->validateDomain($value)) {
            return false;
        }

        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = __('hf-validator.error_invalid_email');
            return false;
        }

        return true;
    }

    public function setCheckDomain(bool $checkDomain): Email
    {
        $this->checkDomain = $checkDomain;
        return $this;
    }

    private function validateDomain(string $email): bool
    {
        $domainName = $this->extractDomain($email);

        if (empty($domainName)) {
            $this->errors[] = __('hf-validator.error_domain_not_resolvable');
            return false;
        }

        if ($this->isCommonDomain($domainName)) {
            return true;
        }

        if (! $this->isResolvableDomain($domainName)) {
            $this->errors[] = __('hf-validator.error_domain_not_reesolvable');
            return false;
        }

        return true;
    }

    private function extractDomain(string $email): ?string
    {
        if (! str_contains($email, '@')) {
            $this->errors[] = __('hf-validator.error_domain_not_resolvable');
            return null;
        }
        $domain = substr(strrchr($email, '@'), 1);
        return empty($domain) ? null : $domain;
    }

    private function isCommonDomain(string $domainName): bool
    {
        return in_array($domainName, $this->mostCommonDomainNames, true);
    }

    private function isResolvableDomain(string $domainName): bool
    {
        return checkdnsrr($domainName, 'MX') || checkdnsrr($domainName, 'A');
    }
}
