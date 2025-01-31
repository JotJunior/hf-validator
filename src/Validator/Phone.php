<?php

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
     * @param string $value The phone number to be validated.
     * @return bool Returns true if the phone number is valid, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        if (empty($value)) {
            return true;
        }

        $validatorClass = __NAMESPACE__ . '\\Phone\\' . strtoupper($this->countryCode);
        if (!class_exists($validatorClass)) {
            $this->addError('ERROR_INVALID_COUNTRY_CODE', self::ERROR_INVALID_COUNTRY_CODE, [$this->countryCode]);
            return false;
        }

        $isValid = (new $validatorClass())->validate($value);

        if (!$isValid) {
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