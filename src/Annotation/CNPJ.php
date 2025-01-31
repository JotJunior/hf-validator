<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents an annotation for handling and validating a CNPJ (Brazilian Corporate Taxpayer Registry).
 * This class provides options for validating the CNPJ format, including its mask, and allows
 * customization of error messages for specific validation failures.
 *
 * @property bool $validateMask Indicates whether the CNPJ mask should be validated.
 * @property array $customErrorMessages An associative array for custom error messages, where keys represent specific error types.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class CNPJ extends AbstractAnnotation
{
    public function __construct(
        public bool  $validateMask = false,
        public array $customErrorMessages = [
            'ERROR_INVALID_CNPJ' => null,
            'ERROR_MASK_MISMATCH' => null,
        ]
    )
    {

    }
}

