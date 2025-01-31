<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents a custom annotation used to validate phone numbers.
 *
 * This class facilitates the validation of phone numbers with a specified country code
 * and allows customization of error messages for invalid phone number cases.
 *
 * The `countryCode` attribute sets the default country code for validation,
 * and `customErrorMessage` allows for detailed error message customization.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Phone extends AbstractAnnotation
{

    public function __construct(
        public string $countryCode = 'BR',
        public array  $customErrorMessages = [
            'ERROR_INVALID_PHONE_NUMBER' => null
        ]
    )
    {
    }
}

