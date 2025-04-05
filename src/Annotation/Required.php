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
 * Defines a required attribute for a property.
 *
 * This attribute indicates that the annotated property must have a value.
 * It includes configuration options for skipping checks during updates
 * and defining custom error messages.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Required extends AbstractAnnotation
{
    public function __construct(
        public bool $onCreate = true,
        public bool $onUpdate = true,
        public array $customErrorMessages = [
            'ERROR_VALUE_REQUIRED' => null,
        ]
    ) {
    }
}
