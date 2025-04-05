<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Annotation as VA;
use Jot\HfValidator\Validator\CNPJ;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(CNPJ::class)]
class CNPJTest extends TestCase
{
    protected CNPJ $cnpjValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $mockQueryBuilder = $this->createMock(QueryBuilder::class);
        $this->cnpjValidator = new CNPJ($mockQueryBuilder);
    }

    /**
     * What is being tested:
     * - CNPJ validator with invalid format
     * Conditions/Scenarios:
     * - CNPJ with incorrect number of digits is provided
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidFormatReturnsFalse(): void
    {
        // Arrange
        $invalidCnpj = '1234567890';

        // Act
        $result = $this->cnpjValidator->validate($invalidCnpj);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator with invalid CNPJ number
     * Conditions/Scenarios:
     * - CNPJ with correct format but invalid check digits is provided
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidCnpjReturnsFalse(): void
    {
        // Arrange
        $invalidCnpj = '12.345.678/9012-34';

        // Act
        $result = $this->cnpjValidator->validate($invalidCnpj);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator with empty value
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithEmptyValueReturnsTrue(): void
    {
        // Arrange
        $emptyCnpj = '';

        // Act
        $result = $this->cnpjValidator->validate($emptyCnpj);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator with non-string input
     * Conditions/Scenarios:
     * - Numeric value is provided as input
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithNumericValueReturnsFalse(): void
    {
        // Arrange
        $numericInput = 1234678910132;

        // Act
        $result = $this->cnpjValidator->validate($numericInput);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator with valid CNPJ number
     * Conditions/Scenarios:
     * - Valid CNPJ with mask is provided
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidFormatReturnsTrue(): void
    {
        // Arrange
        $validCnpj = '32.403.065/0001-74';

        // Act
        $result = $this->cnpjValidator->validate($validCnpj);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator with mask validation enabled
     * Conditions/Scenarios:
     * - Valid CNPJ without mask is provided
     * - Mask validation is enabled
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidMaskReturnsFalse(): void
    {
        // Arrange
        $this->cnpjValidator->setValidateMask(true);
        $cnpjWithoutMask = '19994721000189';

        // Act
        $result = $this->cnpjValidator->validate($cnpjWithoutMask);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator with custom error messages
     * Conditions/Scenarios:
     * - Valid CNPJ without mask is provided
     * - Mask validation is enabled
     * - Custom error message is set for mask mismatch
     * Expected results:
     * - Validation fails (returns false)
     * - Custom error message is used
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidMaskReturnsFalseWithCustomMessage(): void
    {
        // Arrange
        $this->cnpjValidator->setValidateMask(true);
        $customErrorMessages = ['ERROR_MASK_MISMATCH' => 'mask mismatch'];
        $this->cnpjValidator->setCustomErrorMessages($customErrorMessages);
        $cnpjWithoutMask = '19994721000189';

        // Act
        $result = $this->cnpjValidator->validate($cnpjWithoutMask);
        $errors = $this->cnpjValidator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertEquals('mask mismatch', $errors[0]);
    }

    /**
     * What is being tested:
     * - CNPJ validator with mask validation enabled and valid mask
     * Conditions/Scenarios:
     * - Valid CNPJ with correct mask is provided
     * - Mask validation is enabled
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidMaskReturnsTrue(): void
    {
        // Arrange
        $this->cnpjValidator->setValidateMask(true);
        $validMaskedCnpj = '32.403.065/0001-74';

        // Act
        $result = $this->cnpjValidator->validate($validMaskedCnpj);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator's isValidMask method with invalid mask
     * Conditions/Scenarios:
     * - CNPJ without mask is provided to isValidMask method
     * Expected results:
     * - Method returns false
     */
    #[Test]
    #[Group('unit')]
    public function testIsValidMaskWithInvalidMaskReturnsFalse(): void
    {
        // Arrange
        $cnpjWithoutMask = '19994721000189';

        // Act
        $result = $this->cnpjValidator->isValidMask($cnpjWithoutMask);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator's isValidMask method with valid mask
     * Conditions/Scenarios:
     * - CNPJ with correct mask is provided to isValidMask method
     * Expected results:
     * - Method returns true
     */
    #[Test]
    #[Group('unit')]
    public function testIsValidMaskWithValidMaskReturnsTrue(): void
    {
        // Arrange
        $validMaskedCnpj = '32.403.065/0001-74';

        // Act
        $result = $this->cnpjValidator->isValidMask($validMaskedCnpj);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - CNPJ validator's annotation functionality
     * Conditions/Scenarios:
     * - Class property is annotated with CNPJ attribute
     * - Property contains a valid CNPJ
     * Expected results:
     * - Validation passes
     */
    #[Test]
    #[Group('unit')]
    public function testIfValidatedByAnnotationReturnsTrue(): void
    {
        // Arrange
        $class = new class {
            #[VA\CNPJ]
            public string $cnpj = '32.403.065/0001-74';
        };
        $validMaskedCnpj = '32.403.065/0001-74';

        // Act & Assert
        $this->assertTrue($this->cnpjValidator->isValidMask($validMaskedCnpj));
    }
}
