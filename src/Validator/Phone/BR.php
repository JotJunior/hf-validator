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

class BR implements CountryPhoneInterface
{
    private const PHONE_PATTERN = '/^\+55(\d{2})(\d{8,9})$/';

    protected array $validAreaCodes = [
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24',
        '27', '28', '31', '32', '33', '34', '35', '37', '38', '41', '42', '43',
        '44', '45', '46', '47', '48', '49', '51', '53', '54', '55', '61', '62',
        '64', '65', '66', '67', '68', '69', '71', '73', '74', '75', '77', '79',
        '81', '82', '83', '84', '85', '86', '87', '88', '89', '91', '92', '93',
        '94', '95', '96', '97', '98', '99',
    ];

    public function validate(string $phone): bool
    {
        $phoneMatches = [];
        if (preg_match(self::PHONE_PATTERN, $phone, $phoneMatches)) {
            $areaCode = $phoneMatches[1];
            $number = $phoneMatches[2];

            return $this->isValidAreaCode($areaCode)
                && ($this->isEightDigitNumber($number)
                    || $this->isNineDigitNumberStartingWithNine($number));
        }

        return false;
    }

    private function isValidAreaCode(string $areaCode): bool
    {
        return in_array($areaCode, $this->validAreaCodes, true);
    }

    private function isEightDigitNumber(string $number): bool
    {
        return strlen($number) === 8;
    }

    private function isNineDigitNumberStartingWithNine(string $number): bool
    {
        return strlen($number) === 9 && $number[0] === '9';
    }
}
