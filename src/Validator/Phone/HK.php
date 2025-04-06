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

class HK extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::HK;

    protected array $validAreaCodes = [
        // Em Hong Kong, os números de telefone começam com os seguintes dígitos
        '2', // Telefones fixos
        '3', // Telefones fixos (IP)
        '5', // Pagers e serviços especiais
        '6', // Serviços especiais
        '7', // Serviços especiais
        '8', // Serviços especiais
        '9', // Telefones móveis
    ];
}
