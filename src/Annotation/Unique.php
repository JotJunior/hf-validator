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
 * Represents a unique constraint annotation that can be applied to a property.
 *
 * This annotation ensures that the value associated with the property
 * is unique within the specified index.
 *
 * Attributes:
 * @param string $index the name of the index to check the uniqueness constraint against
 * @param string $field the name of the field for which the uniqueness constraint applies
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Unique extends AbstractAnnotation
{
    public function __construct(
        public string $index,
        public string $field
    ) {
    }
}
