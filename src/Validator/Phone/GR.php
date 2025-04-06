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

class GR extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::GR;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '69', // Operadoras móveis

        // Códigos de área fixos
        '21', // Atenas e região
        '22', // Grécia Central e Ilhas do Egeu
        '23', // Macedônia do Norte e Trácia
        '24', // Tessália e Epiro
        '25', // Macedônia Oriental e Trácia
        '26', // Peloponeso e Grécia Ocidental
        '27', // Peloponeso
        '28', // Creta

        // Serviços especiais
        '70', // Serviços de valor agregado
        '80', // Números gratuitos
        '90', // Serviços premium
    ];
}
