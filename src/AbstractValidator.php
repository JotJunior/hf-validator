<?php

namespace Jot\HfValidator;

use Jot\HfElastic\QueryBuilder;

class AbstractValidator
{
    public const ERROR_MUST_BE_DATETIME = 'The value must be a DateTime object.';
    public const ERROR_MUST_BE_NUMERIC = 'The value must be a numeric value.';
    public const ERROR_MUST_BE_STRING = 'The value must be a string value.';
    public const ERROR_NOT_A_STRING = 'The provided value is not a string.';

    protected array $customErrorMessages = [];

    public function __construct(
        protected QueryBuilder $queryBuilder
    )
    {
    }

    protected array $errors = [];

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

    /**
     * Adds an error message to the errors array based on a specified key, default message, and optional replacements.
     *
     * @param string $key The key used to fetch the error message from the custom error messages.
     * @param string|null $default The default error message to use if no message exists for the provided key.
     * @param array $replacements An associative array of replacements to format the error message.
     *
     * $customMessage = 'the fox is %s';
     * Example: $this->>addError($customMessage, self::DEFAULT_MESSAGE, ['red'])
     * Will result in 'the fox is red'
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

        $this->errors[] = vsprintf($this->customErrorMessages[$key] ?? $default, $replacements);
    }

    public function setCustomErrorMessages(array $customErrorMessages): AbstractValidator
    {
        $this->customErrorMessages = $customErrorMessages;
        return $this;
    }

}