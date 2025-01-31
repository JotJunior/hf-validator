<?php

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;


class Ip extends AbstractValidator implements ValidatorInterface
{

    public const ERROR_INVALID_IP_ADDRESS = 'Invalid IP address';
    private bool $ipv4 = true;
    private bool $ipv6 = true;

    /**
     * Validates the given value to check if it is an invalid IPv4 or IPv6 address.
     *
     * @param mixed $value The value to validate.
     * @return bool Returns true if the value is an invalid IPv4 or IPv6 address, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (!$this->isInvalidIpv4($value) && !$this->isInvalidIpv6($value)) {
            $this->addError('ERROR_INVALID_IP_ADDRESS', self::ERROR_INVALID_IP_ADDRESS);
            return false;
        }
        return true;
    }

    /**
     * Determines if the provided value is an invalid IPv4 address.
     *
     * @param mixed $value The value to be checked if it is a valid IPv4 address.
     * @return bool Returns true if the value is an invalid IPv4 address, otherwise false.
     */
    private function isInvalidIpv4(mixed $value): bool
    {
        return $this->ipv4 && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Checks if the given value is an invalid IPv6 address.
     *
     * @param mixed $value The value to be validated as an IPv6 address.
     * @return bool Returns true if the value is an invalid IPv6 address, otherwise false.
     */
    private function isInvalidIpv6(mixed $value): bool
    {
        return $this->ipv6 && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
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


}

