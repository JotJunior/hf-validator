<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents a regular expression annotation that can be applied to properties.
 * Enables validation of values against the specified regular expression pattern.
 *
 * Attributes:
 * - pattern: The regular expression pattern to validate the value.
 * - customErrorMessages: Optional array of custom error messages that may be
 *   used to override default error messages for specific validation failures.
 *   Keys:
 *     - 'ERROR_INVALID_PATTERN': Message for invalid pattern definition.
 *     - 'ERROR_VALUE_DOES_NOT_MATCH': Message when a value does not match
 *       the regular expression pattern.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Regex extends AbstractAnnotation
{

    public function __construct(
        public string $pattern,
        public array  $customErrorMessages = [
            'ERROR_INVALID_PATTERN' => null,
            'ERROR_VALUE_DOES_NOT_MATCH' => null
        ]
    )
    {
    }

}