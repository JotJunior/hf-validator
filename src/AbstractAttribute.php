<?php

namespace Jot\HfValidator;

use Hyperf\Di\Annotation\AbstractAnnotation;

class AbstractAttribute extends AbstractAnnotation
{
    protected array $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

}