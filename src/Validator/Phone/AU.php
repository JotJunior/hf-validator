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

class AU extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::AU;

    protected array $validAreaCodes = [
        // Mobile phone prefixes
        '04', '05', '46',
        // Geographic area codes
        '02', // NSW/ACT
        '03', // VIC/TAS
        '07', // QLD
        '08', // WA/SA/NT
    ];
}
