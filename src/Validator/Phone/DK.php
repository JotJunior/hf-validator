<?php

namespace Jot\HfValidator\Validator\Phone;

class DK extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::DK;

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