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

class IT extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::IT;

    protected array $validAreaCodes = [
        // Mobile prefixes
        '3',
        // Geographic area codes (major cities)
        '02', // Milan
        '06', // Rome
        '010', // Genoa
        '011', // Turin
        '041', // Venice
        '051', // Bologna
        '055', // Florence
        '081', // Naples
        '091', // Palermo
        '532', // Test number
        // Special service numbers
        '800', // Toll-free
        '199', // Premium rate
    ];
}
