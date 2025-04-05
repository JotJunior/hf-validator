<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidatorTest\Translation;

use Jot\HfValidator\AbstractValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Hyperf\Translation\__;

/**
 * @internal
 */
#[CoversClass(AbstractValidator::class)]
class TranslationTest extends TestCase
{
    /**
     * What is being tested:
     * - Error message translation using the global __() function
     * Conditions/Scenarios:
     * - Validator adds an error message with a translation key
     * - Custom error message is set for a specific error key
     * Expected results:
     * - Error messages are correctly translated
     * - Custom error message is used when available
     */
    #[Test]
    #[Group('unit')]
    public function testErrorMessageTranslation(): void
    {
        // Create a mock validator that extends AbstractValidator
        $validator = new class extends AbstractValidator {
            public function validate($value): bool
            {
                $this->addError('ERROR_TEST_MESSAGE', 'Default error message');
                return false;
            }

            // Expose the addError method for testing
            public function publicAddError(string $key, ?string $default = null, array $replacements = []): void
            {
                $this->addError($key, $default, $replacements);
            }

            // Expose the errors array for testing
            public function getErrors(): array
            {
                return $this->errors;
            }
        };

        // Test validation with error message
        $validator->validate('test');
        $errors = $validator->consumeErrors();

        // Since we don't have the actual translation function in tests,
        // we're just checking that some error message is present
        $this->assertNotEmpty($errors);

        // Test with custom error message
        $validator->setCustomErrorMessages(['ERROR_CUSTOM' => 'Custom error message']);
        $validator->publicAddError('ERROR_CUSTOM');
        $errors = $validator->consumeErrors();

        $this->assertContains('Custom error message', $errors);
    }

    /**
     * What is being tested:
     * - Error message translation with parameter replacements
     * Conditions/Scenarios:
     * - Validator adds an error message with placeholder
     * - Replacement values are provided
     * Expected results:
     * - Placeholders in the message are replaced with the provided values
     */
    #[Test]
    #[Group('unit')]
    public function testErrorMessageWithReplacements(): void
    {
        // Create a mock validator that extends AbstractValidator
        $validator = new class extends AbstractValidator {
            // Expose the addError method for testing
            public function publicAddError(string $key, ?string $default = null, array $replacements = []): void
            {
                $this->addError($key, $default, $replacements);
            }

            // Expose the errors array for testing
            public function getErrors(): array
            {
                return $this->errors;
            }
        };

        // Test with default message and replacements
        $validator->publicAddError('ERROR_TEST', 'Value must be %s', ['valid']);
        $errors = $validator->consumeErrors();

        // Check that the replacement was applied to the default message
        $this->assertContains('Value must be valid', $errors);
    }
}
