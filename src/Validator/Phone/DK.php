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

class DK extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::DK;

    protected array $validAreaCodes = [
        // Na Dinamarca, os números de telefone têm 8 dígitos sem códigos de área internos
        // Os prefixos indicam o tipo de serviço
        '2', // Telefones móveis
        '3', // Copenhague e arredores
        '4', // Zealândia e ilhas
        '5', // Números especiais
        '6', // Jutlândia
        '7', // Jutlândia
        '8', // Jutlândia oriental e Funen
        '9', // Jutlândia setentrional
    ];
}
