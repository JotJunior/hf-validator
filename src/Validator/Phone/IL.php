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

class IL extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::IL;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '5', // Operadoras móveis (50-58)

        // Códigos de área fixos
        '2', // Jerusalém
        '3', // Tel Aviv
        '4', // Haifa
        '8', // Sul (Beer Sheva)
        '9', // Sharon (Netanya, Herzliya)

        // Serviços especiais
        '1', // Números curtos e serviços
        '7', // VoIP e números virtuais
    ];
}
