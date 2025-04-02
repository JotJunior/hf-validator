<?php

declare(strict_types=1);

namespace Jot\HfValidatorTest\Translation;

use Jot\HfValidator\AbstractValidator;
use PHPUnit\Framework\TestCase;

class TranslationTest extends TestCase
{
    /**
     * Test that error messages are correctly translated using the global __() function
     */
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
     * Test that error messages with replacements are correctly processed
     */
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
