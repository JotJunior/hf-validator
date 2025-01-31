<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;


/**
 * Represents a unique constraint annotation that can be applied to a property.
 *
 * This annotation ensures that the value associated with the property
 * is unique within the specified index.
 *
 * Attributes:
 * @param string $index The name of the index to check the uniqueness constraint against.
 * @param string $field The name of the field for which the uniqueness constraint applies.
 * @param array $customErrorMessages An optional array allowing customization of error messages:
 *   - `ERROR_VALUE_ALREADY_USED`: Custom error message when the value already exists.
 *   - `ERROR_INVALID_ENTITY_OBJECT`: Custom error message for invalid entity objects when field is an entity object.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Unique extends AbstractAnnotation
{
    public function __construct(
        public string $index,
        public string $field,
        public array  $customErrorMessages = [
            'ERROR_VALUE_ALREADY_USED' => null,
            'ERROR_INVALID_ENTITY_OBJECT' => null
        ]
    )
    {
    }
}