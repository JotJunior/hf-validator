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

class HU extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::HU;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '20', // Telenor
        '30', // T-Mobile (Magyar Telekom)
        '31', // Tesco Mobile (MVNO)
        '50', // Vodafone
        '70', // Vodafone

        // Códigos de área fixos
        '1', // Budapeste
        '22', // Székesfehérvár
        '23', // Biatorbágy
        '24', // Szigetszentmiklós
        '25', // Dunaújváros
        '26', // Szentendre
        '27', // Vác
        '28', // Gödöllő
        '29', // Monor
        '32', // Salgótarján
        '33', // Esztergom
        '34', // Tatabánya
        '35', // Balassagyarmat
        '36', // Eger
        '37', // Gyöngyös
        '42', // Nyíregyháza
        '44', // Mátészalka
        '45', // Kisvárda
        '46', // Miskolc
        '47', // Szerencs
        '48', // Ózd
        '49', // Mezőkövesd
        '52', // Debrecen
        '53', // Cegléd
        '54', // Berettyóújfalu
        '56', // Szolnok
        '59', // Karcag
        '62', // Szeged
        '63', // Szentes
        '66', // Békéscsaba
        '68', // Orosháza
        '69', // Mohács
        '72', // Pécs
        '73', // Szigetvár
        '74', // Szekszárd
        '75', // Paks
        '76', // Kecskemét
        '77', // Kiskunhalas
        '78', // Kiskőrös
        '79', // Baja
        '82', // Kaposvár
        '83', // Keszthely
        '84', // Siófok
        '85', // Marcali
        '87', // Tapolca
        '88', // Veszprém
        '89', // Pápa
        '92', // Zalaegerszeg
        '93', // Nagykanizsa
        '94', // Szombathely
        '95', // Sárvár
        '96', // Győr
        '99', // Sopron

        // Serviços especiais
        '21', // VoIP
        '38', // Serviços corporativos
        '40', // Números compartilhados
        '80', // Números gratuitos
        '90', // Serviços premium
    ];
}
