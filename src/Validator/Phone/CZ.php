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

class CZ extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::CZ;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '601', '602', '603', '604', '605', '606', '607', '608', '609', // O2
        '70', '72', '73', '77', '79', // T-Mobile
        '71', '74', '75', '76', '78', // Vodafone

        // Códigos de área fixos
        '2', // Praga
        '31', '32', // Bohemia Central
        '35', // Karlovy Vary
        '37', // Plzeň
        '38', // Bohemia do Sul
        '39', // Bohemia do Sul
        '41', '47', '48', // Bohemia do Norte
        '46', '49', // Bohemia Oriental
        '51', '53', '54', '55', '56', '57', '58', '59', // Moravia

        // Serviços especiais
        '800', // Números gratuitos
        '81', '83', // Números compartilhados
        '84', '90', '97', // Serviços premium
    ];
}
