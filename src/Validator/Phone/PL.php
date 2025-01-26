<?php

namespace Jot\HfValidator\Validator\Phone;

class US implements CountryValidatorInterface
{
    private CountryPhonePatterns $pattern = CountryPhonePatterns::PL;

    /**
     * Validates a given phone number against a predefined pattern.
     *
     * @param string $phone The phone number to validate.
     * @return bool Returns true if the phone number matches the pattern, otherwise false.
     */
    public function validate(string $phone): bool
    {
        return preg_match(sprintf('/^\%s$/', $this->pattern->value), $phone) === 1;
    }

}