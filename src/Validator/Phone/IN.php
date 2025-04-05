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

class IN extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::IN;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '7', '8', '9',
        // Códigos de área geográficos (principais cidades)
        '11', // Delhi
        '22', // Mumbai
        '33', // Kolkata
        '44', // Chennai
        '20', // Pune
        '40', // Hyderabad
        '79', // Ahmedabad
        '80', // Bangalore
        '141', // Jaipur
        '422', // Coimbatore
        '471', // Thiruvananthapuram
        // Códigos de serviços especiais
        '1800', // Números gratuitos
    ];
}
