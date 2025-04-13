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
 * Represents an attribute for defining an enumeration constraint on a property.
 * Allows specifying a predefined list of acceptable values and custom error messages.
 *
 * @property array $values The list of acceptable values for the property.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Enum extends AbstractAnnotation
{
    public function __construct(
        public array $values
    ) {
    }
}
