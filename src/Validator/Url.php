<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Url extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected bool $forceHttps = false, protected bool $checkDomain = false)
    {
    }


    /**
     * Validates whether the given value is a valid URL.
     *
     * @param mixed $value The value to validate as a URL.
     * @return bool Returns true if the value is a valid URL, otherwise false.
     */
    private function isValidUrl(mixed $value): bool
    {
        $isValid = filter_var($value, FILTER_VALIDATE_URL) !== false;
        if (!$isValid) {
            $this->errors[] = 'Invalid URL';
        }
        return $isValid;
    }

    /**
     * Checks if the given URL has the "https" scheme.
     *
     * @param string $url The URL to check.
     * @return bool Returns true if the URL has the "https" scheme, otherwise false.
     */
    private function hasHttpsScheme(string $url): bool
    {
        $isValid = parse_url($url, PHP_URL_SCHEME) === 'https';
        if (!$isValid) {
            $this->errors[] = 'URL must use https scheme';
        }
        return $isValid;
    }

    /**
     * Checks if the domain in the provided URL is resolvable via DNS.
     *
     * @param string $url The URL containing the domain to check.
     * @return bool Returns true if the domain is resolvable, otherwise false.
     */
    private function isDomainResolvable(string $url): bool
    {
        $domain = parse_url($url, PHP_URL_HOST);
        $isValid = $domain !== null && (checkdnsrr($domain, 'A') || checkdnsrr($domain, 'AAAA'));
        if (!$isValid) {
            $this->errors[] = 'Domain not resolvable';
        }
        return $isValid;
    }

    /**
     * Validates the given value based on configured rules.
     *
     * @param mixed $value The value to validate.
     * @return bool Returns true if the value passes all validation checks, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (!$this->isValidUrl($value)) {
            return false;
        }

        if ($this->forceHttps && !$this->hasHttpsScheme($value)) {
            return false;
        }

        if ($this->checkDomain && !$this->isDomainResolvable($value)) {
            return false;
        }

        return true;
    }


}

