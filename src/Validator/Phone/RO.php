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

class RO extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::RO;

    protected array $mobilePrefixes = ['7'];

    protected array $validAreaCodes = [
        // Fixed line area codes
        '21', // Bucharest
        '22', // Bucharest county
        '23', // Ilfov county
        '24', // Ialomița county
        '25', // Teleorman county
        '26', // Giurgiu county
        '27', // Dâmbovița county
        '30', // Argeș county
        '31', // Prahova county
        '32', // Buzău county
        '33', // Vrancea county
        '34', // Bacău county
        '35', // Vaslui county
        '36', // Galați county
        '37', // Neamț county
        '38', // Iași county
        '39', // Botoșani county
        '40', // Suceava county
        '41', // Brăila county
        '42', // Tulcea county
        '43', // Constanța county
        '44', // Călărași county
        '45', // Gorj county
        '46', // Mehedinți county
        '47', // Dolj county
        '48', // Olt county
        '49', // Vâlcea county
        '50', // Sibiu county
        '51', // Alba county
        '54', // Mureș county
        '55', // Harghita county
        '56', // Covasna county
        '57', // Brașov county
        '58', // Hunedoara county
        '59', // Caraș-Severin county
        '60', // Timiș county
        '61', // Arad county
        '62', // Bihor county
        '63', // Sălaj county
        '64', // Cluj county
        '65', // Bistrița-Năsăud county
        '66', // Maramureș county
        '67', // Satu Mare county

        // Special services
        '800', // Toll-free numbers
        '900', // Premium rate services
    ];
}
