<?php

namespace Jot\HfValidator\Validator\Phone;

class PL extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::PL;

    protected array $validAreaCodes = [];

    /**
     * @TODO Implement the logic to dynamically validate area codes
     */
    public function validate(string $phone): bool
    {
        $regexPattern = $this->buildPattern($this->pattern);
        return preg_match($regexPattern, $phone) === 1;
    }

}