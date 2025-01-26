<?php

namespace Jot\HfValidator\Validator\Phone;

class BR implements CountryValidatorInterface
{
    private array $validDDDs = [
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24',
        '27', '28', '31', '32', '33', '34', '35', '37', '38', '41', '42', '43',
        '44', '45', '46', '47', '48', '49', '51', '53', '54', '55', '61', '62',
        '64', '65', '66', '67', '68', '69', '71', '73', '74', '75', '77', '79',
        '81', '82', '83', '84', '85', '86', '87', '88', '89', '91', '92', '93',
        '94', '95', '96', '97', '98', '99'
    ];

    public function validate(string $phone): bool
    {
        $matches = [];
        if (preg_match('/^\+55(\d{2})(\d{8,9})$/', $phone, $matches)) {
            $ddd = $matches[1];
            $number = $matches[2];

            if (!in_array($ddd, $this->validDDDs, true)) {
                return false;
            }

            if (strlen($number) === 8) {
                return true;
            }

            if (strlen($number) === 9 && $number[0] === '9') {
                return true;
            }
        }

        return false;
    }
}