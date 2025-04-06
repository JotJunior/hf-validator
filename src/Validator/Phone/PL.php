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

class PL extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::PL;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '5', // Operadoras móveis
        '6', // Operadoras móveis
        '7', // Operadoras móveis
        '8', // Operadoras móveis

        // Códigos de área fixos
        '12', // Kraków
        '13', // Krosno
        '14', // Tarnów
        '15', // Tarnobrzeg
        '16', // Przemyśl
        '17', // Rzeszów
        '18', // Nowy Sącz
        '22', // Warszawa
        '23', // Ciechanów
        '24', // Płock
        '25', // Siedlce
        '29', // Ostrołęka
        '32', // Katowice
        '33', // Bielsko-Biała
        '34', // Częstochowa
        '41', // Kielce
        '42', // Łódź
        '43', // Sieradz
        '44', // Piotrków Trybunalski
        '46', // Skierniewice
        '48', // Radom
        '52', // Bydgoszcz
        '54', // Włocławek
        '55', // Elbląg
        '56', // Toruń
        '58', // Gdańsk
        '59', // Słupsk
        '61', // Poznań
        '62', // Kalisz
        '63', // Konin
        '65', // Leszno
        '67', // Piła
        '68', // Zielona Góra
        '71', // Wrocław
        '74', // Wałbrzych
        '75', // Jelenia Góra
        '76', // Legnica
        '77', // Opole
        '81', // Lublin
        '82', // Chełm
        '83', // Biała Podlaska
        '84', // Zamość
        '85', // Białystok
        '86', // Łomża
        '87', // Suwałki
        '89', // Olsztyn
        '91', // Szczecin
        '94', // Koszalin
        '95', // Gorzów Wielkopolski

        // Serviços especiais
        '19', // Serviços especiais
        '39', // VoIP
        '70', // Números premium
        '80', // Números gratuitos
    ];
}
