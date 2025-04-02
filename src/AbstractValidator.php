<?php

namespace Jot\HfValidator;

use Jot\HfElastic\Contracts\QueryBuilderInterface;

class AbstractValidator
{
    public const ERROR_MUST_BE_DATETIME = 'ERROR_MUST_BE_DATETIME';
    public const ERROR_MUST_BE_NUMERIC = 'ERROR_MUST_BE_NUMERIC';
    public const ERROR_MUST_BE_STRING = 'ERROR_MUST_BE_STRING';
    public const ERROR_NOT_A_STRING = 'ERROR_NOT_A_STRING';

    protected array $customErrorMessages = [];
    protected bool $onCreate = true;
    protected bool $onUpdate = true;
    protected string $context = 'onCreate';
    protected array $errors = [];

    public function __construct(
        protected QueryBuilderInterface $queryBuilder
    )
    {
    }

    public function consumeErrors(): array
    {
        $errors = $this->errors;
        $this->resetErrors();
        return $errors;
    }

    public function resetErrors(): void
    {
        $this->errors = [];
    }

    public function setCustomErrorMessages(array $customErrorMessages): AbstractValidator
    {
        $this->customErrorMessages = $customErrorMessages;
        return $this;
    }

    public function setOnCreate(bool $onCreate): self
    {
        $this->onCreate = $onCreate;
        return $this;
    }

    public function setOnUpdate(bool $onUpdate): self
    {
        $this->onUpdate = $onUpdate;
        return $this;
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

    /**
     * Adds an error message to the errors array based on a specified key, default message, and optional replacements.
     *
     * @param string $key The key used to fetch the error message from the custom error messages.
     * @param string|null $default The default error message to use if no message exists for the provided key.
     * @param array $replacements An associative array of replacements to format the error message.
     *
     * @return void
     */
    protected function addError(string $key, ?string $default = null, array $replacements = []): void
    {
        $replacements = array_map(fn($value) => match (true) {
            $value instanceof \DateTimeInterface => $value->format('Y-m-d\TH:i:s.uO'),
            is_array($value), is_object($value) => json_encode($value),
            default => $value,
        }, $replacements);

        // Check if custom error message exists for this key
        if (isset($this->customErrorMessages[$key])) {
            $message = vsprintf($this->customErrorMessages[$key], $replacements);
        } else {
            // Use global translation function with namespace
            $translationKey = 'hf-validator.' . $key;
            $message = __(
                $translationKey, 
                $replacements
            );
            
            // Fallback to default message if translation is not available
            if ($message === $translationKey && $default !== null) {
                $message = vsprintf($default, $replacements);
            }
        }

        $this->errors[] = $message;
    }
}