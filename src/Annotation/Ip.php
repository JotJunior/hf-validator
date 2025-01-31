<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;


/**
 * Defines an annotation to validate IP addresses.
 *
 * This annotation can be applied to properties, specifying whether the IP
 * validation should allow IPv4, IPv6, or both. Custom error messages can
 * also be provided for validation errors.
 *
 * @param bool $ipv4 Indicates if IPv4 validation is enabled. Default is true.
 * @param bool $ipv6 Indicates if IPv6 validation is enabled. Default is true.
 * @param array $customErrorMessages Defines custom error messages for validation errors.
 *                                    Default includes an error message for invalid IP addresses.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Ip extends AbstractAnnotation
{

    public function __construct(
        protected bool $ipv4 = true,
        protected bool $ipv6 = true,
        public array   $customErrorMessages = [
            'ERROR_INVALID_IP_ADDRESS' => null,
        ]
    )
    {
    }


}

