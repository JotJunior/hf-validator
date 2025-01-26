<?php

namespace Jot\HfValidator\Validator\Phone;

interface CountryValidatorInterface
{
    public function validate(string $phone): bool;
}