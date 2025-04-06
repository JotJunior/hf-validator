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

class IE extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::IE;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '83', // Three Ireland
        '85', // Vodafone
        '86', // O2/Three Ireland
        '87', // Vodafone
        '88', // eMobile/Meteor
        '89', // Tesco Mobile/Three Ireland

        // Códigos de área fixos
        '1', // Dublin
        '21', // Cork
        '22', // Mallow
        '23', // Bandon
        '24', // Youghal
        '25', // Fermoy
        '26', // Macroom
        '27', // Bantry
        '28', // Skibbereen
        '29', // Kanturk
        '402', '404', '406', '41', '42', '43', '44', '45', '46', '47', '49', // Leste e Nordeste
        '504', '505', '51', '52', '53', '56', '57', '58', '59', // Sudeste
        '61', '62', '63', '64', '65', '66', '67', '68', '69', // Sul e Centro
        '71', '74', // Noroeste
        '90', '91', '93', '94', '95', '96', '97', '98', '99', // Oeste e Midlands

        // Serviços especiais
        '76', // VoIP
        '70', // Serviços pessoais
        '818', // Números de custo compartilhado
        '800', // Números gratuitos
        '15', '16', // Números curtos
    ];
}
