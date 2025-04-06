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

class Phone extends AbstractValidator implements ValidatorInterface
{
    public const ERROR_INVALID_PHONE_NUMBER = 'Invalid phone number.';

    public const ERROR_INVALID_COUNTRY_CODE = 'No validator found for country code: %s. Please provide a valid country code.';

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

        $pattern = \Jot\HfValidator\Validator\CountryPhonePatterns::forCountry($countryCode);
        if ($pattern === null) {
            $this->addError('ERROR_INVALID_COUNTRY_CODE', self::ERROR_INVALID_COUNTRY_CODE, [$this->countryCode]);
            return false;
        }

        $validatorClass = "\\Jot\\HfValidator\\Validator\\Phone\\{$countryCode}";
        $validator = new $validatorClass();

        $isValid = $validator->validate($value);

        if (! $isValid) {
            $this->addError('ERROR_INVALID_PHONE_NUMBER', self::ERROR_INVALID_PHONE_NUMBER);
        }

        return $isValid;
    }

    public function setCountryCode(string $countryCode): Phone
    {
        $this->countryCode = $countryCode;
        return $this;
    }
}
