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

class TR extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::TR;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '5', // Operadoras móveis

        // Códigos de área fixos
        '212', // Istanbul - Europa
        '216', // Istanbul - Ásia
        '222', // Eskişehir
        '224', // Bursa
        '232', // Izmir
        '236', // Manisa
        '242', // Antalya
        '246', // Isparta
        '248', // Burdur
        '252', // Muğla
        '256', // Aydın
        '258', // Denizli
        '262', // Kocaeli
        '264', // Sakarya
        '266', // Balıkesir
        '272', // Afyonkarahisar
        '274', // Kütahya
        '276', // Uşak
        '282', // Tekirdağ
        '284', // Edirne
        '286', // Çanakkale
        '288', // Kırklareli
        '312', // Ankara
        '318', // Kırıkkale
        '322', // Adana
        '324', // Mersin
        '326', // Hatay
        '328', // Osmaniye
        '332', // Konya
        '338', // Karaman
        '342', // Gaziantep
        '344', // Kahramanmaraş
        '346', // Sivas
        '348', // Kilis
        '352', // Kayseri
        '354', // Yozgat
        '356', // Tokat
        '358', // Amasya
        '362', // Samsun
        '364', // Çorum
        '366', // Kastamonu
        '368', // Sinop
        '370', // Karabük
        '372', // Zonguldak
        '374', // Bartın
        '376', // Çankırı
        '378', // Bolu
        '380', // Düzce
        '382', // Nevşehir
        '384', // Niğde
        '386', // Kırşehir
        '388', // Aksaray
        '412', // Diyarbakır
        '414', // Şanlıurfa
        '416', // Adıyaman
        '422', // Malatya
        '424', // Elazığ
        '426', // Bingol
        '428', // Tunceli
        '432', // Van
        '434', // Bitlis
        '436', // Muş
        '438', // Hakkari
        '442', // Erzurum
        '446', // Erzincan
        '452', // Ordu
        '454', // Giresun
        '456', // Gümüşhane
        '458', // Bayburt
        '462', // Trabzon
        '464', // Rize
        '466', // Artvin
        '472', // Ağrı
        '474', // Kars
        '476', // Iğdır
        '478', // Ardahan
        '482', // Mardin
        '484', // Siirt
        '486', // Şırnak
        '488', // Batman

        // Serviços especiais
        '444', // Serviços corporativos
        '800', // Números gratuitos
        '850', // Números de custo compartilhado
        '900', // Serviços premium
    ];
}
