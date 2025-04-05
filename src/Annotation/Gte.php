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
 * Represents a "greater than or equal to" validation rule for a property.
 * Ensures that the value of the property meets the specified criteria.
 *
 * @property DateTimeInterface|float $value The value against which the property is validated.
 *                                          It can be a datetime or numeric value.
 *
 * @property array $customErrorMessages An associative array of custom error messages where:
 *                                      - 'ERROR_MESSAGE' specifies the general error message.
 *                                      - 'ERROR_MUST_BE_DATETIME' specifies the error message if the expected value is a datetime.
 *                                      - 'ERROR_MUST_BE_NUMERIC' specifies the error message if the expected value is numeric.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Gte extends AbstractAnnotation
{
    public function __construct(
        public DateTimeInterface|float $value,
        public array $customErrorMessages = [
            'ERROR_MESSAGE' => null,
            'ERROR_MUST_BE_DATETIME' => null,
            'ERROR_MUST_BE_NUMERIC' => null,
        ]
    ) {
    }
}
