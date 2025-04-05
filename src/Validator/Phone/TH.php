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

class TH extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::TH;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '6', // Operadoras móveis
        '8', // Operadoras móveis
        '9', // Operadoras móveis

        // Códigos de área fixos
        '2', // Bangkok
        '3', // Nonthaburi, Pathum Thani, Samut Prakan
        '4', // Nordeste da Tailândia
        '5', // Norte da Tailândia
        '7', // Sul da Tailândia

        // Serviços especiais
        '1', // Serviços especiais e emergência
        '800', // Números gratuitos
        '900', // Serviços premium
    ];
}
