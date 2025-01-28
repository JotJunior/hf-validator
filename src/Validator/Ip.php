<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Ip extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected bool $ipv4 = true, protected bool $ipv6 = true)
    {
    }

    /**
     * Validates the given value to check if it is an invalid IPv4 or IPv6 address.
     *
     * @param mixed $value The value to validate.
     * @return bool Returns true if the value is an invalid IPv4 or IPv6 address, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if ($this->isInvalidIpv4($value)) {
            return true;
        }

        if ($this->isInvalidIpv6($value)) {
            return true;
        }

        return false;
    }

    /**
     * Determines if the provided value is an invalid IPv4 address.
     *
     * @param mixed $value The value to be checked if it is a valid IPv4 address.
     * @return bool Returns true if the value is an invalid IPv4 address, otherwise false.
     */
    private function isInvalidIpv4(mixed $value): bool
    {
        if ($this->ipv4 && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $this->errors[] = 'Invalid IPv4 address';
            return true;
        }
        return false;
    }

    /**
     * Checks if the given value is an invalid IPv6 address.
     *
     * @param mixed $value The value to be validated as an IPv6 address.
     * @return bool Returns true if the value is an invalid IPv6 address, otherwise false.
     */
    private function isInvalidIpv6(mixed $value): bool
    {
        if ($this->ipv6 && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $this->errors[] = 'Invalid IPv6 address';
            return true;
        }
        return false;
    }


}

