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
 * Defines a password validation rule with customizable requirements.
 *
 * This annotation validates a password based on configurable properties such as
 * length, inclusion of specific character types, and custom error messages.
 *
 * @param bool $requireLower specifies if at least one lowercase letter is required
 * @param bool $requireUpper specifies if at least one uppercase letter is required
 * @param bool $requireNumber specifies if at least one numerical digit is required
 * @param bool $requireSpecial specifies if at least one special character is required
 * @param int $minLength Specifies the minimum length of the password. Default is 8.
 * @param int $maxLength Specifies the maximum length of the password. Default is 50.
 * @param array $special defines the set of special characters to be accepted
 * @param array $customErrorMessages specifies custom error messages for validation failures,
 *                                   keyed by error code
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Password extends AbstractAnnotation
{
    public function __construct(
        public bool $requireLower = true,
        public bool $requireUpper = true,
        public bool $requireNumber = true,
        public bool $requireSpecial = true,
        public int $minLength = 8,
        public int $maxLength = 50,
        public string $special = '!@#$%&*_',
        public array $customErrorMessages = []
    ) {
    }
}
