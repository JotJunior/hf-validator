<?php

namespace Jot\HfValidator;

interface ValidatorInterface
{

    public function validate(string $value, array $options = []): bool;

    public function getErrors(): array;

}