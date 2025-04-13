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
 * Represents a custom annotation used to validate phone numbers.
 *
 * This class facilitates the validation of phone numbers with a specified country code
 * and allows customization of error messages for invalid phone number cases.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Phone extends AbstractAnnotation
{
    public function __construct(
        public string $countryCode = 'BR'
    ) {
    }
}
