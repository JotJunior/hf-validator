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

class ID extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::ID;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '8', // Operadoras móveis

        // Códigos de área fixos
        '21', // Jakarta
        '22', // Bandung
        '24', // Semarang
        '31', // Surabaya
        '61', // Medan
        '62', // Pekanbaru
        '65', // Balikpapan
        '71', // Palembang
        '73', // Banjarmasin
        '81', // Makassar
        '98', // Ambon

        // Serviços especiais
        '0', // Números internacionais
        '1', // Serviços especiais
        '9', // Serviços premium
    ];
}
