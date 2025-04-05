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

class Url extends AbstractValidator implements ValidatorInterface
{
    public const ERROR_INVALID_URL = 'Invalid URL';

    public const ERROR_URL_MUST_USE_HTTPS_SCHEME = 'URL must use https scheme';

    public const ERROR_DOMAIN_NOT_RESOLVABLE = 'Domain not resolvable';

    private bool $forceHttps = false;

    private bool $checkDomain = false;

    /**
     * Validates the given value based on configured rules.
     *
     * @param mixed $value the value to validate
     * @return bool returns true if the value passes all validation checks, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! $this->isValidUrl($value)) {
            return false;
        }

        if ($this->forceHttps && ! $this->hasHttpsScheme($value)) {
            return false;
        }

        if ($this->checkDomain && ! $this->isDomainResolvable($value)) {
            return false;
        }

        return true;
    }

    public function setForceHttps(bool $forceHttps): Url
    {
        $this->forceHttps = $forceHttps;
        return $this;
    }

    public function setCheckDomain(bool $checkDomain): Url
    {
        $this->checkDomain = $checkDomain;
        return $this;
    }

    /**
     * Validates whether the given value is a valid URL.
     *
     * @param mixed $value the value to validate as a URL
     * @return bool returns true if the value is a valid URL, otherwise false
     */
    private function isValidUrl(mixed $value): bool
    {
        $isValid = filter_var($value, FILTER_VALIDATE_URL) !== false;
        if (! $isValid) {
            $this->addError('ERROR_INVALID_URL', self::ERROR_INVALID_URL);
        }
        return $isValid;
    }

    /**
     * Checks if the given URL has the "https" scheme.
     *
     * @param string $url the URL to check
     * @return bool returns true if the URL has the "https" scheme, otherwise false
     */
    private function hasHttpsScheme(string $url): bool
    {
        $isValid = parse_url($url, PHP_URL_SCHEME) === 'https';
        if (! $isValid) {
            $this->addError('ERROR_URL_MUST_USE_HTTPS_SCHEME', self::ERROR_URL_MUST_USE_HTTPS_SCHEME);
        }
        return $isValid;
    }

    /**
     * Checks if the domain in the provided URL is resolvable via DNS.
     *
     * @param string $url the URL containing the domain to check
     * @return bool returns true if the domain is resolvable, otherwise false
     */
    private function isDomainResolvable(string $url): bool
    {
        $domain = parse_url($url, PHP_URL_HOST);
        $isValid = $domain !== null && (checkdnsrr($domain, 'A') || checkdnsrr($domain, 'AAAA'));
        if (! $isValid) {
            $this->addError('ERROR_DOMAIN_NOT_RESOLVABLE', self::ERROR_DOMAIN_NOT_RESOLVABLE);
        }
        return $isValid;
    }
}
