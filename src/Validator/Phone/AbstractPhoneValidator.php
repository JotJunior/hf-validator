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

abstract class AbstractPhoneValidator implements CountryPhoneInterface
{
    protected array $validAreaCodes = [];

    protected array $mobilePrefixes = ['9'];

    protected CountryPhonePatterns $pattern;

    /**
     * Validate a phone number based on country pattern.
     *
     * @param string $phone The phone number to validate
     * @return bool True if the phone number is valid
     */
    public function validate(string $phone): bool
    {
        $regexPattern = $this->buildPattern($this->pattern);

        $areaCode = $this->extractAreaCode($phone);
        if (! $this->isValidAreaCode($areaCode)) {
            return false;
        }

        return preg_match($regexPattern, $phone) === 1;
    }

    /**
     * Build a regex pattern for phone number validation.
     *
     * @param CountryPhonePatterns $pattern The country phone pattern
     * @return string The regex pattern
     */
    protected function buildPattern(CountryPhonePatterns $pattern): string
    {
        $prefix = $pattern->getDialingCode();
        $lengths = $pattern->getPhoneNumberLength();

        $lengthPatterns = [];
        foreach ($lengths as $length) {
            $lengthPatterns[] = "\\d{{$length}}";
        }

        // Juntar os padrões com OR (|)
        $lengthPattern = implode('|', $lengthPatterns);

        // Padrão que aceita o código do país seguido pelo número correto de dígitos
        return sprintf('/^\%s(%s)$/', $prefix, $lengthPattern);
    }

    /**
     * Extract the area code from a phone number if it matches a valid area code.
     * @param string $phone The phone number to extract the area code from
     * @return string The extracted area code if found, or null if no valid area code is matched
     */
    protected function extractAreaCode(string $phone): string
    {
        $areaCode = null;
        foreach ($this->validAreaCodes as $code) {
            $prefix = sprintf('%s%s', $this->pattern->getDialingCode(), $areaCode);
            if (str_starts_with($phone, $prefix)) {
                return (string) $code;
            }
            foreach ($this->mobilePrefixes as $mobilePrefix) {
                $prefix = sprintf('%s%s%s', $this->pattern->getDialingCode(), $mobilePrefix, $areaCode);
                if (str_starts_with($phone, $prefix)) {
                    return (string) $code;
                }
            }
        }
        return '';
    }

    /**
     * Check if the area code is valid.
     *
     * @param int|string $areaCode The area code to validate
     * @return bool True if the area code is valid
     */
    protected function isValidAreaCode(int|string $areaCode): bool
    {
        // Se não houver códigos de área definidos, qualquer código é válido
        if (empty($this->validAreaCodes)) {
            return true;
        }

        return in_array((string) $areaCode, array_map('strval', $this->validAreaCodes));
    }

    /**
     * Validate if the area code in the phone number is valid.
     *
     * @param string $phone The phone number to validate
     * @return bool True if the area code is valid
     */
    protected function validateAreaCode(string $phone): bool
    {
        $prefix = $this->pattern->getDialingCode();
        $prefixLength = strlen($prefix);

        $phoneWithoutPrefix = substr($phone, $prefixLength);

        if ($this->pattern === CountryPhonePatterns::US_CA) {
            $areaCode = substr($phoneWithoutPrefix, 0, 3);
            return $this->isValidAreaCode((int) $areaCode);
        }

        foreach ([1, 2, 3, 4] as $areaCodeLength) {
            if (strlen($phoneWithoutPrefix) < $areaCodeLength) {
                continue;
            }

            $potentialAreaCode = substr($phoneWithoutPrefix, 0, $areaCodeLength);
            if ($this->isValidAreaCode($potentialAreaCode)) {
                return true;
            }
        }

        return empty($this->validAreaCodes);
    }
}
