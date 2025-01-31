<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents a range constraint. This class is typically used to validate
 * that a given value falls within a specified range.
 *
 * The range can be defined using minimum and maximum values, which can either
 * be dates or numeric values. Custom error messages can also be defined for
 * scenarios where the value is not within the specified range.
 *
 * @property \DateTimeInterface|float $min The minimum value allowed for the range.
 * @property \DateTimeInterface|float $max The maximum value allowed for the range.
 * @property array $customErrorMessages An associative array of custom error messages where:
 *                                       - 'ERROR_MESSAGE' specifies the general error message.
 *                                       - 'ERROR_MUST_BE_DATETIME' specifies the error message if the expected value is a datetime.
 *                                       - 'ERROR_MUST_BE_NUMERIC' specifies the error message if the expected value is numeric.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Range extends AbstractAnnotation
{

    public function __construct(
        public \DateTimeInterface|float $min,
        public \DateTimeInterface|float $max,
        public array                    $customErrorMessages = [
            'ERROR_OUT_OF_RANGE' => null,
            'ERROR_MUST_BE_DATETIME' => null,
            'ERROR_MUST_BE_NUMERIC' => null,
        ]
    )
    {
    }

}