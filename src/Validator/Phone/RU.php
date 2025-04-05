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

class RU extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::RU;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '9',
        // Códigos de área geográficos (principais cidades)
        '495', // Moscou
        '812', // São Petersburgo
        '343', // Ecaterimburgo
        '383', // Novosibirsk
        '846', // Samara
        '863', // Rostov-on-Don
        '473', // Voronezh
        '831', // Nizhny Novgorod
        '843', // Kazan
        '861', // Krasnodar
        '351', // Chelyabinsk
        '391', // Krasnoyarsk
        '423', // Vladivostok
        '342', // Perm
        '4212', // Khabarovsk
        // Códigos de serviços especiais
        '800', // Números gratuitos
    ];
}
