<?php

namespace Jot\HfValidator;

use Hyperf\Contract\ContainerInterface;
use Hyperf\Di\Annotation\AbstractAnnotation;

class AbstractAttribute extends AbstractAnnotation
{
    protected array $errors = [];
    protected array $options = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setContainer(?ContainerInterface $container)
    {

    }

}