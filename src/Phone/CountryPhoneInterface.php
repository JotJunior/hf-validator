<?php

namespace Jot\HfValidator\Phone;

interface CountryPhoneInterface
{
    public function validate(string $phone): bool;
}