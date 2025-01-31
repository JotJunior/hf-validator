<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents an attribute for defining an enumeration constraint on a property.
 * Allows specifying a predefined list of acceptable values and custom error messages.
 *
 * @property array $values The list of acceptable values for the property.
 * @property array $customErrorMessage An array of custom error messages for validation errors,
 *                                      with keys representing error codes and values as their respective messages.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Enum extends AbstractAnnotation
{

    public function __construct(
        public array  $values,
        public array $customErrorMessages = [
            'ERROR_VALUE_OUT_OF_PREDEFINED_LIST' => null
        ]
    )
    {
    }

}