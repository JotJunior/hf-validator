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

class UA extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::UA;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '39', // Golden Telecom
        '50', // Vodafone
        '63', // Lifecell
        '66', // Vodafone
        '67', // Kyivstar
        '68', // Kyivstar
        '73', // Lifecell
        '91', // TriMob
        '92', // PeopleNet
        '93', // Lifecell
        '94', // Intertelecom
        '95', // Vodafone
        '96', // Kyivstar
        '97', // Kyivstar
        '98', // Kyivstar
        '99', // Vodafone

        // Códigos de área fixos
        '31', // Zakarpattia
        '32', // Lviv
        '33', // Volyn
        '34', // Ivano-Frankivsk
        '35', // Ternopil
        '36', // Rivne
        '37', // Chernivtsi
        '38', // Khmelnytskyi
        '41', // Zhytomyr
        '43', // Vinnytsia
        '44', // Kiev
        '45', // Kiev Oblast
        '46', // Chernihiv
        '47', // Cherkasy
        '48', // Odessa
        '51', // Mykolaiv
        '52', // Kirovohrad
        '53', // Poltava
        '54', // Sumy
        '55', // Kherson
        '56', // Dnipropetrovsk
        '57', // Kharkiv
        '61', // Zaporizhzhia
        '62', // Donetsk
        '64', // Luhansk
        '65', // Crimea (Simferopol)

        // Serviços especiais
        '800', // Números gratuitos
        '900', // Serviços premium
    ];
}
