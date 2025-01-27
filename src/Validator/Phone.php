<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\AbstractAttribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Phone extends AbstractAttribute implements ValidatorInterface
{

    public function __construct(protected string $countryCode)
    {
    }


    /**
     * Validates the given value using the appropriate phone number validator
     * based on the country code.
     *
     * @param string $value The phone number to be validated.
     * @return bool Returns true if the phone number is valid, otherwise false.
     */
    public function validate(mixed $value): bool
    {
        $validatorClass = __NAMESPACE__ . '\\Phone\\' . strtoupper($this->countryCode);
        if (!class_exists($validatorClass)) {
            $this->errors[] = sprintf('No validator found for country code: %s. Please provide a valid country code.', $this->countryCode);
            return false;
        }

        $isValid = (new $validatorClass())->validate($value);

        if (!$isValid) {
            $this->errors[] = 'Invalid phone number.';
        }

        return $isValid;
    }
}