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

class Ip extends AbstractValidator implements ValidatorInterface
{
    private bool $ipv4 = true;

    private bool $ipv6 = true;

    /**
     * Validates the given value to check if it is an invalid IPv4 or IPv6 address.
     *
     * @param mixed $value the value to validate
     * @return bool returns true if the value is an invalid IPv4 or IPv6 address, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (! $this->isInvalidIpv4($value) && ! $this->isInvalidIpv6($value)) {
            $this->errors[] = __('hf-validator.error_invalid_ip_address');
            return false;
        }
        return true;
    }

    public function setIpv4(bool $ipv4): Ip
    {
        $this->ipv4 = $ipv4;
        return $this;
    }

    public function setIpv6(bool $ipv6): Ip
    {
        $this->ipv6 = $ipv6;
        return $this;
    }

    /**
     * Determines if the provided value is an invalid IPv4 address.
     *
     * @param mixed $value the value to be checked if it is a valid IPv4 address
     * @return bool returns true if the value is an invalid IPv4 address, otherwise false
     */
    private function isInvalidIpv4(mixed $value): bool
    {
        return $this->ipv4 && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Checks if the given value is an invalid IPv6 address.
     *
     * @param mixed $value the value to be validated as an IPv6 address
     * @return bool returns true if the value is an invalid IPv6 address, otherwise false
     */
    private function isInvalidIpv6(mixed $value): bool
    {
        return $this->ipv6 && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }
}
