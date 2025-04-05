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

class PH extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::PH;

    protected array $validAreaCodes = [
        // Códigos de área fixos
        '2', // Metro Manila
        '32', // Cebu
        '33', // Iloilo
        '34', // Bacolod
        '35', // Roxas
        '36', // Kalibo
        '38', // Masbate
        '42', // Lucena
        '43', // Calapan
        '44', // Batangas
        '45', // San Fernando, Pampanga
        '46', // Cabanatuan
        '47', // Iba, Zambales
        '48', // Mamburao
        '49', // San Jose, Occidental Mindoro
        '52', // Legazpi
        '53', // Naga
        '54', // Daet
        '55', // Catanduanes
        '56', // Sorsogon
        '62', // Baguio
        '63', // Tuguegarao
        '64', // Ilagan
        '65', // Aparri
        '68', // Laoag
        '72', // Tarlac
        '74', // Dagupan
        '75', // Urdaneta
        '77', // Lingayen
        '78', // San Fernando, La Union
        '82', // Davao
        '83', // Tagum
        '84', // Mati
        '85', // Digos
        '86', // Cotabato
        '87', // Kidapawan
        '88', // Cagayan de Oro
        '89', // Dipolog

        // Serviços especiais
        '800', // Números gratuitos
    ];
}
