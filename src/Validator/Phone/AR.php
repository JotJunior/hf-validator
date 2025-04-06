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

use Jot\HfValidator\Validator\AbstractPhoneValidator;
use Jot\HfValidator\Validator\CountryPhoneInterface;
use Jot\HfValidator\Validator\CountryPhonePatterns;

class AR extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::AR;

    protected array $validAreaCodes = [
        // Principais códigos de área da Argentina
        '11', // Buenos Aires
        '351', // Córdoba
        '341', // Rosario
        '261', // Mendoza
        '221', // La Plata
        '223', // Mar del Plata
        '381', // San Miguel de Tucumán
        '387', // Salta
        '342', // Santa Fe
        '264', // San Juan
        '362', // Resistencia
        '385', // Santiago del Estero
        '379', // Corrientes
        '376', // Posadas
        '388', // San Salvador de Jujuy
        '291', // Bahía Blanca
        '343', // Paraná
        '370', // Formosa
        '299', // Neuquén
        '358', // Río Cuarto
    ];

    /**
     * Validate a phone number for Argentina.
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

    protected function extractAreaCode(string $phone): string
    {
        if (preg_match('/^\+549(\d{3})/', $phone, $matches)) {
            $areaCode = $matches[1];
            if (str_starts_with($areaCode, '3')) {
                return '11';
            }
        }

        if (preg_match('/^\+54(\d{3})/', $phone, $matches)) {
            $areaCode = $matches[1];

            if (str_starts_with($areaCode, '11')) {
                return '11';
            }
        }

        return '';
    }
}
