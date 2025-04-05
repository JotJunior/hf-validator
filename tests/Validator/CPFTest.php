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
use Jot\HfValidator\Validator\CPF;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(CPF::class)]
class CPFTest extends TestCase
{
    private CPF $cpfValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->cpfValidator = new CPF($queryBuilder);
    }

    /**
     * What is being tested:
     * - CPF validator with valid CPF numbers
     * Conditions/Scenarios:
     * - Valid CPF in numeric format
     * - Valid CPF with mask
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidCPF(): void
    {
        // Arrange
        $validNumericCPF = '57804827059';
        $validMaskedCPF = '578.048.270-59';

        // Act & Assert
        $this->assertTrue($this->cpfValidator->validate($validNumericCPF));
        $this->assertTrue($this->cpfValidator->validate($validMaskedCPF));
        $this->assertEmpty($this->cpfValidator->consumeErrors());
    }

    /**
     * What is being tested:
     * - CPF validator with empty value
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testEmptyCPF(): void
    {
        // Arrange
        $emptyCPF = '';

        // Act
        $result = $this->cpfValidator->validate($emptyCPF);

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($this->cpfValidator->consumeErrors());
    }

    /**
     * What is being tested:
     * - CPF validator with invalid CPF numbers
     * Conditions/Scenarios:
     * - Invalid CPF with mask
     * - Invalid CPF without mask
     * Expected results:
     * - Validation fails (returns false)
     * - Error message for invalid CPF is generated
     */
    #[Test]
    #[Group('unit')]
    public function testInvalidCPF(): void
    {
        // Arrange
        $invalidMaskedCPF = '123.456.789-00';
        $invalidNumericCPF = '12345678900';

        // Act
        $this->assertFalse($this->cpfValidator->validate($invalidMaskedCPF));
        $this->assertFalse($this->cpfValidator->validate($invalidNumericCPF));

        // Assert
        $this->assertContains(CPF::ERROR_INVALID_CPF, $this->cpfValidator->consumeErrors());
    }

    /**
     * What is being tested:
     * - CPF validator with non-string input
     * Conditions/Scenarios:
     * - Numeric value is provided as input
     * Expected results:
     * - Validation fails (returns false)
     * - Error message for non-string input is generated
     */
    #[Test]
    #[Group('unit')]
    public function testNonStringCPF(): void
    {
        // Arrange
        $numericInput = 12345678901;

        // Act
        $result = $this->cpfValidator->validate($numericInput);

        // Assert
        $this->assertFalse($result);
        $this->assertContains(CPF::ERROR_NOT_A_STRING, $this->cpfValidator->consumeErrors());
    }

    /**
     * What is being tested:
     * - CPF validator with repeated digits
     * Conditions/Scenarios:
     * - CPF with all digits the same
     * Expected results:
     * - Validation fails (returns false)
     * - Error message for malformed CPF is generated
     */
    #[Test]
    #[Group('unit')]
    public function testRepeatedDigitsCPF(): void
    {
        // Arrange
        $repeatedDigitsCPF = '11111111111';

        // Act
        $result = $this->cpfValidator->validate($repeatedDigitsCPF);

        // Assert
        $this->assertFalse($result);
        $this->assertContains(CPF::ERROR_MALFORMED_CPF, $this->cpfValidator->consumeErrors());
    }

    /**
     * What is being tested:
     * - CPF validator with mask validation enabled
     * Conditions/Scenarios:
     * - Valid CPF with correct mask
     * - Mask validation is enabled
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidMaskCPF(): void
    {
        // Arrange
        $this->cpfValidator->setValidateMask(true);
        $validMaskedCPF = '578.048.270-59';

        // Act
        $result = $this->cpfValidator->validate($validMaskedCPF);

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($this->cpfValidator->consumeErrors());
    }

    /**
     * What is being tested:
     * - CPF validator with mask validation enabled and incorrect mask
     * Conditions/Scenarios:
     * - CPF with incorrect mask format
     * - Mask validation is enabled
     * Expected results:
     * - Validation fails (returns false)
     * - Error message for mask mismatch is generated
     */
    #[Test]
    #[Group('unit')]
    public function testInvalidMaskCPF(): void
    {
        // Arrange
        $this->cpfValidator->setValidateMask(true);
        $incorrectlyMaskedCPF = '578048270-59';

        // Act
        $result = $this->cpfValidator->validate($incorrectlyMaskedCPF);

        // Assert
        $this->assertFalse($result);
        $this->assertContains(CPF::ERROR_MASK_MISMATCH, $this->cpfValidator->consumeErrors());
    }
}
