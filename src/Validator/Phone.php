<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Validator;

use Jot\HfValidator\AbstractValidator;
use Jot\HfValidator\ValidatorInterface;

use function Hyperf\Translation\__;

class Phone extends AbstractValidator implements ValidatorInterface
{
    private string $countryCode = 'BR';

    /**
     * Validates the given value using the appropriate phone number validator
     * based on the country code.
     *
     * @param string $value the phone number to be validated
     * @return bool returns true if the phone number is valid, otherwise false
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        $countryCode = strtoupper($this->countryCode);

        $pattern = CountryPhonePatterns::forCountry($countryCode);
        if ($pattern === null) {
            $this->errors[] = __('hf-validator.error_invalid_country_code');
            return false;
        }

        $validatorClass = "\\Jot\\HfValidator\\Validator\\Phone\\{$countryCode}";
        $validator = new $validatorClass();

        $isValid = $validator->validate($value);

        if (! $isValid) {
            $this->errors[] = __('hf-validator.error_invalid_phone_number');
        }

        return $isValid;
    }

    public function setCountryCode(string $countryCode): Phone
    {
        $this->countryCode = $countryCode;
        return $this;
    }
}
