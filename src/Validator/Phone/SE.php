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

class SE extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::SE;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '7', // Operadoras móveis

        // Códigos de área fixos
        '8', // Stockholm
        '10', // Números não geográficos
        '11', // Norrköping
        '13', // Linköping
        '16', // Eskilstuna
        '18', // Uppsala
        '19', // Örebro
        '21', // Västerås
        '23', // Falun
        '26', // Gävle
        '31', // Göteborg
        '33', // Borås
        '35', // Halmstad
        '36', // Jönköping
        '40', // Malmö
        '42', // Helsingborg
        '44', // Kristianstad
        '46', // Lund
        '54', // Karlstad
        '60', // Sundsvall
        '63', // Östersund
        '90', // Umeå
        '920', // Luleå

        // Serviços especiais
        '20', // Números gratuitos
        '77', // Números de custo compartilhado
        '900', // Serviços premium
        '939', // Serviços premium
        '944', // Serviços premium
    ];
}
