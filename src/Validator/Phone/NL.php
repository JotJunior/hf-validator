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

class NL extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::NL;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '6', // Operadoras móveis

        // Códigos de área fixos
        '10', // Rotterdam
        '20', // Amsterdam
        '30', // Utrecht
        '40', // Eindhoven
        '50', // Groningen
        '70', // Den Haag
        '73', // Den Bosch
        '76', // Breda
        '85', // VoIP

        // Outros códigos de área regionais
        '11', '13', '14', '15', '16', '17', '18',
        '22', '23', '24', '25', '26', '27', '28', '29',
        '31', '33', '34', '35', '36', '38',
        '41', '43', '45', '46', '47', '48', '49',
        '51', '52', '53', '54', '55', '56', '57', '58', '59',
        '71', '72', '74', '75', '77', '78', '79',
        '88', '91', '97', '98', '99',

        // Serviços especiais
        '800', // Números gratuitos
        '900', // Serviços premium
    ];
}
