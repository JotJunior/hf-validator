<?php

namespace Jot\HfValidator\Validator\Phone;

class NO extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::NO;

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