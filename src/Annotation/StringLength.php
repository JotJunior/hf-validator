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
 * Represents a constraint for validating the length of a string.
 *
 * This attribute can be applied to properties to enforce that the length
 * of the associated string falls within a specific range, defined by the
 * optional minimum and maximum parameters.
 *
 * Attributes:
 * @param null|int $min Specifies the minimum length the string must have. Defaults to null, meaning no minimum constraint.
 * @param null|int $max Specifies the maximum length the string can have. Defaults to null, meaning no maximum constraint.
 * @param array $customErrorMessages an associative array allowing customization of error messages
 *                                   for validation failures, such as when the string length is outside the allowed range
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class StringLength extends AbstractAnnotation
{
    public function __construct(
        public ?int $min = null,
        public ?int $max = null,
        public array $customErrorMessages = [
            'ERROR_MIN_LENGTH' => null,
            'ERROR_MAX_LENGTH' => null,
        ]
    ) {
    }
}
