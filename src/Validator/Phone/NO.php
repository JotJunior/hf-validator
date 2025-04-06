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

class NO extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::NO;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '4', // Operadoras móveis (40-49)
        '9', // Operadoras móveis (90-99)

        // Códigos de área fixos
        '2', // Oslo e região
        '3', // Sudeste
        '5', // Oeste
        '6', // Centro
        '7', // Norte
        '8', // Norte

        // Serviços especiais
        '0', // Serviços especiais
        '1', // Serviços especiais
        '800', // Números gratuitos
        '810', // Números de custo compartilhado
        '820', // Números de custo compartilhado
        '829', // VoIP
        '85', // VoIP
        '880', // Números de custo compartilhado
        '882', // M2M (Machine to Machine)
    ];
}
