<?php

namespace Jot\HfValidator\Phone;

enum CountryPhonePatterns: string
{

    case BR = '+55:10,11';
    case US_CA = '+1:10';
    case IN = '+91:10';
    case MX = '+52:10';
    case AU = '+61:10';
    case NZ = '+64:10';
    case GB = '+44:10';
    case DE = '+49:10';
    case FR = '+33:10';
    case IT = '+39:10';
    case ES = '+34:10';
    case NL = '+31:10';
    case SE = '+46:10';
    case CH = '+41:10';
    case AT = '+43:10';
    case BE = '+32:10';
    case LU = '+352:10';
    case PT = '+351:10';
    case DK = '+45:10';
    case FI = '+358:10';
    case NO = '+47:10';
    case IE = '+353:10';
    case PL = '+48:10';
    case RU = '+7:10';
    case UA = '+380:10';
    case CZ = '+420:10';
    case SK = '+421:10';
    case HU = '+36:10';
    case TR = '+90:10';
    case AR = '+54:10';
    case CL = '+56:10';
    case PE = '+51:10';
    case VE = '+58:10';
    case CO = '+57:10';

    public function getDialingCode(): string
    {
        return explode(':', $this->value)[0];
    }

    public function getPhoneNumberLength(): array
    {
        $lengths = explode(':', $this->value)[1];
        return array_map('intval', explode(',', $lengths)); // Retorna um array de inteiros
    }

    public static function forCountry(string $countryCode): ?self
    {
        // Usando um mapeamento de códigos de país para enums
        $map = [
            'BR' => self::BR,
            'US' => self::US_CA,
            'CA' => self::US_CA,
            'IN' => self::IN,
            'MX' => self::MX,
            'AU' => self::AU,
            'NZ' => self::NZ,
            'GB' => self::GB,
            'DE' => self::DE,
            'FR' => self::FR,
            'IT' => self::IT,
            'ES' => self::ES,
            'NL' => self::NL,
            'SE' => self::SE,
            'CH' => self::CH,
            'AT' => self::AT,
            'BE' => self::BE,
            'LU' => self::LU,
            'PT' => self::PT,
            'DK' => self::DK,
            'FI' => self::FI,
            'NO' => self::NO,
            'IE' => self::IE,
            'PL' => self::PL,
            'RU' => self::RU,
            'UA' => self::UA,
            'CZ' => self::CZ,
            'SK' => self::SK,
            'HU' => self::HU,
            'TR' => self::TR,
            'AR' => self::AR,
            'CL' => self::CL,
            'PE' => self::PE,
            'VE' => self::VE,
            'CO' => self::CO,
        ];

        return $map[$countryCode] ?? null;
    }

}
