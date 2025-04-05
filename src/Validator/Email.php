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

class Email extends AbstractValidator implements ValidatorInterface
{
    public const ERROR_INVALID_EMAIL = 'Invalid email';

    public const ERROR_DOMAIN_NOT_RESOLVABLE = 'The domain name for this email address is not resolvable.';

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
            $this->addError('ERROR_NOT_A_STRING', self::ERROR_NOT_A_STRING);
            return false;
        }

        if ($this->checkDomain && ! $this->validateDomain($value)) {
            return false;
        }

        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError('ERROR_INVALID_EMAIL', self::ERROR_INVALID_EMAIL);
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
            $this->addError('ERROR_DOMAIN_NOT_RESOLVABLE', self::ERROR_DOMAIN_NOT_RESOLVABLE);
            return false;
        }

        if ($this->isCommonDomain($domainName)) {
            return true;
        }

        if (! $this->isResolvableDomain($domainName)) {
            $this->addError('ERROR_DOMAIN_NOT_RESOLVABLE', self::ERROR_DOMAIN_NOT_RESOLVABLE);
            return false;
        }

        return true;
    }

    private function extractDomain(string $email): ?string
    {
        if (! str_contains($email, '@')) {
            $this->addError('ERROR_DOMAIN_NOT_RESOLVABLE', self::ERROR_DOMAIN_NOT_RESOLVABLE);
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
