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
 * Represents an annotation for validating email addresses.
 *
 * This class is used to validate whether a given string is formatted as a proper email address.
 * Additionally, it supports optional validation to check if the domain of the email is resolvable.
 *
 * @param bool $checkDomain specifies whether to check if the email domain is resolvable
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Email extends AbstractAnnotation
{
    public function __construct(
        public bool $checkDomain = false
    ) {
    }
}
