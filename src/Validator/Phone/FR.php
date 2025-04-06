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

class FR extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::FR;

    protected array $validAreaCodes = [
        // Mobile prefixes
        '6', '7',
        // Geographic area codes
        '1', // Paris and Île-de-France
        '2', // Northwest France
        '3', // Northeast France
        '4', // Southeast France
        '5', // Southwest France
        // Special service numbers
        '8', // Toll-free and shared-cost numbers
        '9', // Non-geographic numbers (VoIP)
    ];
}
