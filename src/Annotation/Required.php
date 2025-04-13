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
 * Represents a validation rule attribute to mark a property as required.
 * Typically used to enforce validation checks during entity lifecycle operations.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Required extends AbstractAnnotation
{
    public function __construct(
        public bool $onCreate = true,
        public bool $onUpdate = true
    ) {
    }
}
