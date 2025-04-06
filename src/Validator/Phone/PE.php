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

class PE extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::PE;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '9', // Operadoras móveis

        // Códigos de área fixos
        '1', // Lima e Callao
        '41', // Cajamarca
        '42', // Lambayeque
        '43', // Ancash
        '44', // La Libertad
        '51', // Arequipa
        '52', // Moquegua
        '53', // Tacna
        '54', // Arequipa
        '56', // Ica
        '61', // Junin
        '62', // Huancavelica
        '63', // Pasco
        '64', // Huanuco
        '65', // Ucayali
        '66', // Loreto
        '67', // San Martin
        '73', // Piura
        '74', // Lambayeque
        '76', // Amazonas
        '82', // Cusco
        '83', // Apurimac
        '84', // Cusco

        // Serviços especiais
        '0', // Serviços especiais
        '80', // Números gratuitos
        '80', // Serviços premium
    ];
}
