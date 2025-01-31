<?php

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents an annotation for CPF (Cadastro de Pessoas Físicas) validation in Brazil.
 *
 * This class provides an option to enable or disable mask validation
 * and allows for custom error messages when validation fails.
 *
 * @param bool $validateMask Specifies whether the CPF mask should be validated.
 * @param array $customErrorMessages Custom error messages for validation errors, including:
 *                                    - 'ERROR_INVALID_CPF': Error for an invalid CPF.
 *                                    - 'ERROR_MALFORMED_CPF': Error for a malformed CPF.
 *                                    - 'ERROR_MASK_MISMATCH': Error for a mismatched CPF mask.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class CPF extends AbstractAnnotation
{
    public function __construct(
        public bool  $validateMask = false,
        public array $customErrorMessages = [
            'ERROR_INVALID_CPF' => null,
            'ERROR_MALFORMED_CPF' => null,
            'ERROR_MASK_MISMATCH' => null,
        ]
    )
    {
    }

}

