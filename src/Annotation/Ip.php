<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

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
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Ip extends AbstractAnnotation
{
    public function __construct(
        protected bool $ipv4 = true,
        protected bool $ipv6 = true
    ) {
    }
}
