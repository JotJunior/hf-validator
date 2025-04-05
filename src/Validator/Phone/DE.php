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

class DE extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::DE;

    protected array $validAreaCodes = [
        // Mobile prefixes
        '15', '16', '17',
        // Geographic area codes (major cities)
        '30', // Berlin
        '40', // Hamburg
        '58', // Teste number
        '69', // Frankfurt
        '89', // Munich
        '201', // Essen
        '211', // Düsseldorf
        '221', // Cologne
        '231', // Dortmund
        '341', // Leipzig
        '351', // Dresden
        '371', // Chemnitz
        '421', // Bremen
        '511', // Hannover
        '587', // Teste number
        '621', // Mannheim
        '711', // Stuttgart
        '911', // Nuremberg
        // Special service numbers
        '800', // Toll-free
        '900', // Premium rate
    ];
}
