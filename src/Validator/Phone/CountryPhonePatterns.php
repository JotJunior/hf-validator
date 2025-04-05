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

enum CountryPhonePatterns: string
{
    case AR = '+54:10,11';
    case AT = '+43:10';
    case AU = '+61:9';
    case BE = '+32:9';
    case BR = '+55:10,11';
    case CL = '+56:8,9';
    case CN = '+86:10,11';
    case CO = '+57:10';
    case CR = '+506:8';
    case CZ = '+420:9';
    case DE = '+49:10,11';
    case DK = '+45:8';
    case ES = '+34:9';
    case FI = '+358:9';
    case FR = '+33:9';
    case GB = '+44:10';
    case GR = '+30:9,10';
    case HK = '+852:8';
    case HU = '+36:9';
    case ID = '+62:10,11';
    case IE = '+353:9';
    case IL = '+972:9';
    case IN = '+91:10';
    case IT = '+39:10';
    case JP = '+81:9,10';
    case LU = '+352:8';
    case MX = '+52:10';
    case NL = '+31:9';
    case NO = '+47:8';
    case NZ = '+64:8,9';
    case PE = '+51:9';
    case PH = '+63:9,10';
    case PL = '+48:9';
    case PT = '+351:9';
    case RO = '+40:9,10';
    case RU = '+7:10';
    case SE = '+46:9';
    case SK = '+421:9';
    case TR = '+90:10';
    case UA = '+380:9';
    case US_CA = '+1:10';
    case VE = '+58:10';
    case ZA = '+27:9';

    public static function forCountry(string $countryCode): ?self
    {
        // Usando um mapeamento de códigos de país para enums
        $map = [
            'AR' => self::AR,
            'AT' => self::AT,
            'AU' => self::AU,
            'BE' => self::BE,
            'BR' => self::BR,
            'CA' => self::US_CA,
            'CL' => self::CL,
            'CN' => self::CN,
            'CO' => self::CO,
            'CR' => self::CR,
            'CZ' => self::CZ,
            'DE' => self::DE,
            'DK' => self::DK,
            'ES' => self::ES,
            'FI' => self::FI,
            'FR' => self::FR,
            'GB' => self::GB,
            'GR' => self::GR,
            'HK' => self::HK,
            'HU' => self::HU,
            'ID' => self::ID,
            'IE' => self::IE,
            'IL' => self::IL,
            'IN' => self::IN,
            'IT' => self::IT,
            'JP' => self::JP,
            'LU' => self::LU,
            'MX' => self::MX,
            'NL' => self::NL,
            'NO' => self::NO,
            'NZ' => self::NZ,
            'PE' => self::PE,
            'PH' => self::PH,
            'PL' => self::PL,
            'PT' => self::PT,
            'RO' => self::RO,
            'RU' => self::RU,
            'SE' => self::SE,
            'SK' => self::SK,
            'TR' => self::TR,
            'UA' => self::UA,
            'US' => self::US_CA,
            'VE' => self::VE,
            'ZA' => self::ZA,
        ];

        return $map[$countryCode] ?? null;
    }

    public function getDialingCode(): string
    {
        return explode(':', $this->value)[0];
    }

    public function getPhoneNumberLength(): array
    {
        $lengths = explode(':', $this->value)[1];
        return array_map('intval', explode(',', $lengths)); // Retorna um array de inteiros
    }
}
