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

class VE extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::VE;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '412', // Movilnet
        '414', // Movistar
        '416', // Digitel
        '424', // Movistar
        '426', // Digitel

        // Códigos de área fixos
        '212', // Distrito Capital e Miranda
        '234', // Aragua
        '235', // Carabobo
        '237', // Carabobo
        '238', // Carabobo
        '239', // Cojedes
        '240', // Portuguesa
        '241', // Yaracuy
        '242', // Lara
        '243', // Lara
        '244', // Falcón
        '245', // Zulia
        '246', // Zulia
        '247', // Zulia
        '248', // Zulia
        '249', // Zulia
        '251', // Trujillo
        '252', // Mérida
        '253', // Mérida
        '254', // Táchira
        '255', // Táchira
        '256', // Barinas
        '257', // Apure
        '258', // Amazonas
        '259', // Bolívar
        '261', // Bolívar
        '262', // Bolívar
        '263', // Delta Amacuro
        '264', // Monagas
        '265', // Monagas
        '266', // Sucre
        '267', // Sucre
        '268', // Anzoátegui
        '269', // Anzoátegui
        '271', // Guárico
        '272', // Guárico
        '273', // Dependencias Federales
        '274', // Nueva Esparta
        '275', // Vargas
        '276', // Miranda
        '277', // Miranda
        '278', // Miranda
        '279', // Miranda
        '281', // Anzoátegui
        '282', // Anzoátegui
        '283', // Anzoátegui
        '284', // Anzoátegui
        '285', // Anzoátegui
        '286', // Anzoátegui
        '287', // Anzoátegui
        '288', // Anzoátegui
        '289', // Anzoátegui
        '291', // Monagas
        '292', // Monagas
        '293', // Sucre
        '294', // Sucre
        '295', // Nueva Esparta

        // Serviços especiais
        '500', // Números gratuitos
        '501', // Números gratuitos
        '800', // Números gratuitos
        '900', // Serviços premium
    ];
}
