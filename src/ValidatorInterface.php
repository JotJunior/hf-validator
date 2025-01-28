<?php

namespace Jot\HfValidator;

interface ValidatorInterface
{

    public function validate(mixed $value): bool;

    public function consumeErrors(): array;

}