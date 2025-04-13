<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator;

use Jot\HfElastic\Contracts\QueryBuilderInterface;

class AbstractValidator
{
    protected ?string $identifier = null;

    protected ?string $property = null;

    protected string $context = 'onCreate';

    protected array $errors = [];

    public function __construct(
        protected QueryBuilderInterface $queryBuilder
    ) {
    }

    public function setContext(string $context): self
    {
        $this->context = sprintf('on%s', ucfirst($context));
        return $this;
    }

    public function consumeErrors(?string $property = null): array
    {
        $errors = $this->errors;
        $this->resetErrors();
        return $errors;
    }

    public function resetErrors(): void
    {
        $this->errors = [];
    }

    public function onCreate(): self
    {
        $this->context = 'onCreate';
        return $this;
    }

    public function onUpdate(): self
    {
        $this->context = 'onUpdate';
        return $this;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function setProperty(?string $property): self
    {
        $this->property = $property;
        return $this;
    }
}
