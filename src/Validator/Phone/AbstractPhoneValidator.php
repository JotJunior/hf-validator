<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Validator\Phone;

abstract class AbstractPhoneValidator
{
    protected array $validAreaCodes = [];

    protected function buildPattern(CountryPhonePatterns $pattern): string
    {
        $prefix = $pattern->getDialingCode();
        $lengths = $pattern->getPhoneNumberLength();
        $lengthPattern = implode(':', $lengths); // Suporte para múltiplos comprimentos

        return sprintf('/^\%s\d{%s}$/', $prefix, $lengthPattern);
    }

    protected function isValidAreaCode(int|string $areaCode): bool
    {
        return in_array($areaCode, $this->validAreaCodes);
    }
}
