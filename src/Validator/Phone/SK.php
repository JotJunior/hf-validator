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

class SK extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::SK;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '9', // Operadoras móveis

        // Códigos de área fixos
        '2', // Bratislava
        '31', // Dunajská Streda
        '32', // Trenčín
        '33', // Trnava
        '34', // Senica
        '35', // Nové Zámky
        '36', // Levice
        '37', // Nitra
        '38', // Topoľčany
        '41', // Žilina
        '42', // Považská Bystrica
        '43', // Martin
        '44', // Liptovský Mikuláš
        '45', // Zvolen
        '46', // Prievidza
        '47', // Lučenec
        '48', // Banská Bystrica
        '51', // Prešov
        '52', // Poprad
        '53', // Spišská Nová Ves
        '54', // Bardejov
        '55', // Košice
        '56', // Michalovce
        '57', // Humenné
        '58', // Rožňava

        // Serviços especiais
        '800', // Números gratuitos
        '850', // Números de custo compartilhado
        '900', // Serviços premium
    ];
}
