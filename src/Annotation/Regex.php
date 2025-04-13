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
 * Represents a regular expression annotation that can be applied to properties.
 * Enables validation of values against the specified regular expression pattern.
 *
 * Attributes:
 * - pattern: The regular expression pattern to validate the value.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Regex extends AbstractAnnotation
{
    public function __construct(
        public string $pattern
    ) {
    }
}
