<?php

namespace Jot\HfValidator\Phone;

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

    private function isValidAreaCode(string $areaCode): bool
    {
        return in_array($areaCode, $this->validAreaCodes, true);
    }

}