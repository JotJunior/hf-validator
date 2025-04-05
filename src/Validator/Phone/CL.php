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

class CL extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::CL;

    protected array $validAreaCodes = [
        // Códigos de área para Santiago e região metropolitana
        '2', // Santiago

        // Códigos de área para outras regiões
        '32', // Valparaíso
        '33', // Quillota
        '34', // San Felipe
        '35', // San Antonio
        '41', // Concepción
        '42', // Chillán
        '43', // Los Ángeles
        '45', // Temuco
        '51', // La Serena, Coquimbo
        '52', // Copiapó
        '53', // Ovalle
        '55', // Antofagasta
        '57', // Arica
        '58', // Iquique
        '61', // Punta Arenas
        '63', // Valdivia
        '64', // Osorno
        '65', // Puerto Montt
        '67', // Coyhaique
        '71', // Talca
        '72', // Rancagua
        '73', // Linares
        '75', // Curicó

        // Prefixos móveis
        '9',
    ];
}
