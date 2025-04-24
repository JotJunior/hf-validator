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
 * Represents an attribute that validates the existence of a value in a specific index and field.
 *
 * This attribute is used to ensure that a given value exists in a specific index and field,
 * allowing for custom error messages to handle validation errors.
 *
 * @param string $index the index where the value is checked for existence
 * @param string $field the field within the index to validate the value against
 * @param string $context the context applied to validation. May be 'global' or 'tenant'
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Exists extends AbstractAnnotation
{
    public function __construct(
        public string $index,
        public string $field,
        public string $level = 'tenant' // global|tenant
    ) {
    }
}
