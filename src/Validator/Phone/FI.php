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

class FI extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::FI;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '4', // Operadoras móveis
        '5', // Operadoras móveis

        // Códigos de área geográficos
        '2', // Turku/Pori
        '3', // Tampere
        '5', // Região leste (Mikkeli, Kuopio)
        '6', // Vaasa
        '8', // Oulu
        '9', // Helsinki

        // Serviços especiais
        '7', // Serviços corporativos
        '1', // Serviços especiais
    ];
}
