<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;


/**
 * Defines a password validation rule with customizable requirements.
 *
 * This annotation validates a password based on configurable properties such as
 * length, inclusion of specific character types, and custom error messages.
 *
 * @param bool $requireLower Specifies if at least one lowercase letter is required.
 * @param bool $requireUpper Specifies if at least one uppercase letter is required.
 * @param bool $requireNumber Specifies if at least one numerical digit is required.
 * @param bool $requireSpecial Specifies if at least one special character is required.
 * @param int $minLength Specifies the minimum length of the password. Default is 8.
 * @param int $maxLength Specifies the maximum length of the password. Default is 50.
 * @param array $special Defines the set of special characters to be accepted.
 * @param array $customErrorMessages Specifies custom error messages for validation failures,
 *                                      keyed by error code.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Password extends AbstractAnnotation
{

    public function __construct(
        public bool   $requireLower = true,
        public bool   $requireUpper = true,
        public bool   $requireNumber = true,
        public bool   $requireSpecial = true,
        public int    $minLength = 8,
        public int    $maxLength = 50,
        public string $special = '!@#$%&*_',
        public array  $customErrorMessages = [
            'ERROR_INVALID_PASSWORD' => 'Your password must have at least %s and be between %s and %s characters long.',
            'ERROR_MATCH_LOWER' => 'one lower case letter',
            'ERROR_MATCH_UPPER' => 'one upper case letter',
            'ERROR_MATCH_NUMBER' => 'one number',
            'ERROR_MATCH_SPECIAL' => 'one special character',
            'ERROR_LENGTH' => 'between %s and %s characters long',
        ]
    )
    {
    }


}