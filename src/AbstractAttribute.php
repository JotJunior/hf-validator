<?php

namespace Jot\HfValidator;

use Hyperf\Di\Annotation\AbstractAnnotation;

class AbstractAttribute extends AbstractAnnotation
{
    protected array $errors = [];
    protected array $options = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

}