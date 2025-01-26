<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Phone extends AbstractAttribute
{

    /**
     * Validates a phone number based on the given value and country-specific options.
     *
     * @param string $value The phone number to be validated.
     * @param array $options Optional configuration parameters. Expected key 'countryCode' to specify the country for validation. Defaults to 'BR'.
     * @return bool Returns true if the phone number is valid, false otherwise.
     * @throws \InvalidArgumentException If no validator is found for the specified country code.
     */
    public function validate(string $value, array $options = []): bool
    {
        $countryCode = $options['countryCode'] ?? 'BR';
        $validatorClass = __NAMESPACE__ . '\\Phone\\' . strtoupper($options['countryCode']);
        if (!class_exists($validatorClass)) {
            throw new \InvalidArgumentException("No validator found for country code: '{$countryCode}'. Please provide a valid country code.");
        }

        return (new $validatorClass())->validate($value);
    }
}