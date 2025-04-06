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

class MX extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::MX;

    protected array $validAreaCodes = [
        // Principais códigos de área do México
        '55', // Cidade do México
        '33', // Guadalajara
        '81', // Monterrey
        '222', // Puebla
        '514', // Número de teste
        '664', // Tijuana
        '998', // Cancún
        '999', // Mérida
        '477', // León
        '444', // San Luis Potosí
        '442', // Querétaro
        '993', // Villahermosa
        '662', // Hermosillo
        '614', // Chihuahua
        '871', // Torreón
        '667', // Culiacán
        '229', // Veracruz
        '443', // Morelia
        '961', // Tuxtla Gutiérrez
        '656', // Ciudad Juárez
        '644', // Ciudad Obregón
    ];
}
