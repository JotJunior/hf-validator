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

class NZ extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::NZ;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '2', // Operadoras móveis

        // Códigos de área fixos
        '3', // Ilha Sul
        '4', // Wellington
        '6', // Ilha Norte (exceto Auckland e Wellington)
        '7', // Hamilton/Waikato
        '9', // Auckland

        // Serviços especiais
        '0', // Serviços especiais
        '1', // Serviços especiais
        '800', // Números gratuitos
        '83', // Serviços de audioconferência
        '900', // Serviços premium
    ];
}
