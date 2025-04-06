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

class ZA extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::ZA;

    protected array $mobilePrefixes = ['6', '7', '8'];

    protected array $validAreaCodes = [
        // Mobile prefixes
        '6', // Mobile operators
        '7', // Mobile operators
        '8', // Mobile operators

        // Fixed line area codes
        '10', // Johannesburg
        '11', // Johannesburg
        '12', // Pretoria
        '13', // Mpumalanga
        '14', // Limpopo
        '15', // Limpopo
        '16', // Vaal Triangle
        '17', // Mpumalanga
        '18', // North West
        '21', // Cape Town
        '22', // Western Cape
        '23', // Western Cape
        '27', // Northern Cape
        '28', // Western Cape
        '31', // Durban
        '32', // KwaZulu-Natal
        '33', // Pietermaritzburg
        '34', // KwaZulu-Natal
        '35', // KwaZulu-Natal
        '36', // KwaZulu-Natal
        '39', // Eastern Cape
        '40', // Port Elizabeth
        '41', // Port Elizabeth
        '42', // Eastern Cape
        '43', // East London
        '44', // Garden Route
        '45', // Eastern Cape
        '46', // Eastern Cape
        '47', // Eastern Cape
        '48', // Eastern Cape
        '49', // Eastern Cape
        '51', // Bloemfontein
        '53', // Northern Cape
        '54', // Northern Cape
        '56', // Free State
        '57', // Free State
        '58', // Free State

        // Special services
        '80', // Toll-free numbers
        '86', // Shared-cost services
        '87', // VoIP services
        '90', // Premium rate services
    ];
}
