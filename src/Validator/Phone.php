<?php

namespace Jot\HfValidator\Validator;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Phone
{

    /**
     * Validates a phone number against a specific country's validation rules.
     * The method checks if a validator exists for the provided country code
     * and applies the validation logic using the corresponding validator.
     *
     * @param string $phone The phone number to validate.
     * @param string $countryCode The country code against which the phone number should be validated.
     *
     * @return bool Returns true if the phone number is valid, false otherwise.
     *
     * @throws \InvalidArgumentException If no validator exists for the given country code.
     */
    public function validate(string $phone, string $countryCode): bool
    {
        $validatorClass = __NAMESPACE__ . '\\Phone\\' . strtoupper($countryCode);
        if (!class_exists($validatorClass)) {
            throw new \InvalidArgumentException("No validator found for country code: '{$countryCode}'. Please provide a valid country code.");
        }

        return (new $validatorClass())->validate($phone);
    }
}