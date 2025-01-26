<?php

namespace Jot\HfValidator\Validator\Phone;

interface CountryPhoneInterface
{
    public function validate(string $phone): bool;
}