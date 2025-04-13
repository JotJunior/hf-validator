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
use DateTimeInterface;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents a range constraint. This class is typically used to validate
 * that a given value falls within a specified range.
 *
 * The range can be defined using minimum and maximum values, which can either
 * be dates or numeric values. Custom error messages can also be defined for
 * scenarios where the value is not within the specified range.
 *
 * @property DateTimeInterface|float $min The minimum value allowed for the range.
 * @property DateTimeInterface|float $max The maximum value allowed for the range.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Range extends AbstractAnnotation
{
    public function __construct(
        public DateTimeInterface|float $min,
        public DateTimeInterface|float $max
    ) {
    }
}
