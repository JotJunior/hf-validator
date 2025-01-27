<?php

namespace Jot\HfValidator\Validator;

use Attribute;
use Jot\HfValidator\ValidatorInterface;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class Password extends Regex implements ValidatorInterface
{

    public function __construct(
        protected bool $requireLower = true,
        protected bool $requireUpper = true,
        protected bool $requireNumber = true,
        protected bool $requireSpecial = true,
        protected int  $minLength = 8,
    )
    {
        $lower = $this->requireLower ? '(?=.*[a-z])' : '';
        $upper = $this->requireUpper ? '(?=.*[A-Z])' : '';
        $number = $this->requireNumber ? '(?=.*\d)' : '';
        $special = $this->requireSpecial ? '(?=.*[!@#$%&*()_\-+])' : '';
        $length = $this->minLength;
        $pattern = sprintf('/^%s%s%s%s.{%d,}$/', $lower, $upper, $number, $special, $length);

        parent::__construct(pattern: $pattern);
    }

}