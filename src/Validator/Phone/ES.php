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

class ES extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::ES;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '6', '7', '87',
        // Códigos de área geográficos (principais cidades)
        '91', // Madrid
        '93', // Barcelona
        '95', // Sevilha
        '96', // Valência
        '98', // Oviedo, Santander
        // Números de serviços especiais
        '80', // Números gratuitos
        '90', // Números premium
    ];
}
