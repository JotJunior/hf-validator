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

class BE extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::BE;

    protected array $validAreaCodes = [
        // Principais códigos de área da Bélgica
        '2', // Bruxelas
        '3', // Antuérpia
        '9', // Gante
        '4', // Liège
        '71', // Charleroi
        '50', // Bruges
        '81', // Namur
        '16', // Leuven
        '65', // Mons
        '53', // Aalst
        '15', // Mechelen
        '56', // Kortrijk
        '11', // Hasselt
        '59', // Ostende
        '69', // Tournai
        '89', // Genk
        '51', // Roeselare
        '87', // Verviers
        '10', // Wavre
    ];
}
