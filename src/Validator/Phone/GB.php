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

class GB extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::GB;

    protected array $validAreaCodes = [
        // Geographic area codes
        '01', // Geographic numbers
        '02', // Geographic numbers (London, Southampton, etc.)
        // Non-geographic numbers
        '03', // National rate numbers
        '07', // Mobile numbers and pagers
        '08', // Special rate numbers
        '09', // Premium rate numbers
        '94', // Test number
    ];
}
