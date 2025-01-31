<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;


/**
 * Represents an annotation for validating email addresses.
 *
 * This class is used to validate whether a given string is formatted as a proper email address.
 * Additionally, it supports optional validation to check if the domain of the email is resolvable.
 *
 * @param bool $checkDomain Specifies whether to check if the email domain is resolvable.
 * @param array $customErrorMessages Customizable error messages for specific validation failures.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Email extends AbstractAnnotation
{

    public function __construct(
        public bool  $checkDomain = false,
        public array $customErrorMessages = [
            'ERROR_INVALID_EMAIL' => null,
            'ERROR_DOMAIN_NOT_RESOLVABLE' => null
        ],
    )
    {
    }

}

