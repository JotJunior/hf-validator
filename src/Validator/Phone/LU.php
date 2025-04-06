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

class LU extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::LU;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '6', // Operadoras móveis

        // Códigos de área fixos
        '2', // Luxemburgo cidade e sul
        '3', // Norte
        '4', // Leste
        '5', // Centro

        // Serviços especiais
        '8', // Números gratuitos
        '9', // Serviços premium
    ];
}
