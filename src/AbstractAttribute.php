<?php

namespace Jot\HfValidator;

use Hyperf\Contract\ContainerInterface;
use Hyperf\Di\Annotation\AbstractAnnotation;

class AbstractAttribute extends AbstractAnnotation
{

    protected array $errors = [];

    public function consumeErrors(): array
    {
        $errors = $this->errors;
        $this->resetErrors();
        return $errors;
    }

    public function setContainer(?ContainerInterface $container)
    {

    }

    public function resetErrors(): void
    {
        $this->errors = [];
    }

}