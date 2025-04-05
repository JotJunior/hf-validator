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

class CR extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::CR;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '6', // Móvel (ICE)
        '7', // Móvel (ICE)
        '8', // Móvel (diversos operadores)

        // Códigos de área fixos
        '2', // Fixo (San José e área metropolitana)
        '4', // Fixo (outras regiões)
    ];
}
