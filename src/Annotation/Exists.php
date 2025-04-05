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
 * @param array $customErrorMessages An array of custom error messages for specific error cases.
 *                                   - 'ERROR_VALUE_DOES_NOT_EXIST': Error message when the value does not exist.
 *                                   - 'ERROR_INVALID_ENTITY': Error message for an invalid entity.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Exists extends AbstractAnnotation
{
    public function __construct(
        public string $index,
        public string $field,
        public array $customErrorMessages = [
            'ERROR_VALUE_DOES_NOT_EXIST' => null,
            'ERROR_INVALID_ENTITY' => null,
        ]
    ) {
    }
}
