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
    case AR = '+54:10';
    case AT = '+43:10';
    case AU = '+61:10';
    case BE = '+32:10';
    case BR = '+55:10,11';
    case CL = '+56:10';
    case CN = '+41:10';
    case CO = '+57:10';
    case CZ = '+420:10';
    case DE = '+49:10';
    case DK = '+45:10';
    case ES = '+34:10';
    case FI = '+358:10';
    case FR = '+33:10';
    case GB = '+44:10';
    case HU = '+36:10';
    case IE = '+353:10';
    case IN = '+91:10';
    case IT = '+39:10';
    case LU = '+352:10';
    case MX = '+52:10';
    case NL = '+31:10';
    case NO = '+47:10';
    case NZ = '+64:10';
    case PE = '+51:10';
    case PL = '+48:10';
    case PT = '+351:10';
    case RU = '+7:10';
    case SE = '+46:10';
    case SK = '+421:10';
    case TR = '+90:10';
    case UA = '+380:10';
    case US_CA = '+1:10';
    case VE = '+58:10';

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
            'AR' => self::AR,
            'AT' => self::AT,
            'AU' => self::AU,
            'BE' => self::BE,
            'BR' => self::BR,
            'CA' => self::US_CA,
            'CL' => self::CL,
            'CN' => self::CN,
            'CO' => self::CO,
            'CZ' => self::CZ,
            'DE' => self::DE,
            'DK' => self::DK,
            'ES' => self::ES,
            'FI' => self::FI,
            'FR' => self::FR,
            'GB' => self::GB,
            'HU' => self::HU,
            'IE' => self::IE,
            'IN' => self::IN,
            'IT' => self::IT,
            'LU' => self::LU,
            'MX' => self::MX,
            'NL' => self::NL,
            'NO' => self::NO,
            'NZ' => self::NZ,
            'PE' => self::PE,
            'PL' => self::PL,
            'PT' => self::PT,
            'RU' => self::RU,
            'SE' => self::SE,
            'SK' => self::SK,
            'TR' => self::TR,
            'UA' => self::UA,
            'US' => self::US_CA,
            'VE' => self::VE,
        ];

        return $map[$countryCode] ?? null;
    }
}
