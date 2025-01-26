<?php

namespace Jot\HfValidator;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Phone extends AbstractAnnotation
{

    public function __construct(
        protected ?string $phone = null,
        protected ?string $countryCode = null
    )
    {
        var_dump($this->phone);
        var_dump($this->countryCode);
    }


    /**
     * Validates a phone number against the specific validator class determined by the country code.
     *
     * @return bool Returns true if the phone number is valid according to the appropriate validator; otherwise, false.
     * @throws \InvalidArgumentException If no validator class exists for the given country code.
     */
    public function validate(): bool
    {
        $validatorClass = __NAMESPACE__ . '\\Phone\\' . strtoupper($this->countryCode);
        if (!class_exists($validatorClass)) {
            throw new \InvalidArgumentException("No validator found for country code: '{$this->countryCode}'. Please provide a valid country code.");
        }

        return (new $validatorClass())->validate($this->phone);
    }
}