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

class CO extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::CO;

    protected array $validAreaCodes = [
        // Códigos de área da Colômbia
        '1', // Bogotá
        '2', // Cali, Pasto, Popayán
        '4', // Medellín, Montería
        '5', // Barranquilla, Cartagena, Santa Marta, Valledupar, Sincelejo
        '6', // Pereira, Manizales, Armenia
        '7', // Cúcuta, Bucaramanga
        '8', // Ibagué, Neiva, Villavicencio, Tunja
    ];
}
