<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Test\Validator;

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
    private CPF $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new CPF();
        // Any other required dependencies
    }

    /**
     * What is being tested:
     * - CPF validation with valid CPF.
     * Conditions/Scenarios:
     * - Input is a valid CPF string.
     * Expected results:
     * - Returns true.
     */
    #[Test]
    #[Group('unit')]
    public function testValidateValidCPFReturnsTrue(): void
    {
        // Arrange
        $validCpf = '12345678909';

        // Act
        $result = $this->sut->validate($validCpf);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - CPF validation with invalid CPF.
     * Conditions/Scenarios:
     * - Input is an invalid CPF string.
     * Expected results:
     * - Returns false.
     */
    #[Test]
    #[Group('unit')]
    public function testValidateInvalidCPFReturnsFalse(): void
    {
        // Arrange
        $invalidCpf = '12345678900';

        // Act
        $result = $this->sut->validate($invalidCpf);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CPF validation with empty CPF.
     * Conditions/Scenarios:
     * - Input is an empty string.
     * Expected results:
     * - Returns true.
     */
    #[Test]
    #[Group('unit')]
    public function testValidateEmptyCPFReturnsTrue(): void
    {
        // Arrange
        $emptyCpf = '';

        // Act
        $result = $this->sut->validate($emptyCpf);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - CPF validation with non-string CPF.
     * Conditions/Scenarios:
     * - Input is not a string.
     * Expected results:
     * - Returns false.
     */
    #[Test]
    #[Group('unit')]
    public function testValidateNonStringCPFReturnsFalse(): void
    {
        // Arrange
        $nonStringCpf = 12345678909;

        // Act
        $result = $this->sut->validate($nonStringCpf);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CPF validation with valid masked CPF.
     * Conditions/Scenarios:
     * - Input is a valid masked CPF string and validateMask is set to true.
     * Expected results:
     * - Returns true.
     */
    #[Test]
    #[Group('unit')]
    public function testValidateValidMaskedCPFReturnsTrue(): void
    {
        // Arrange
        $validMaskedCpf = '123.456.789-09';
        $this->sut->setValidateMask(true);

        // Act
        $result = $this->sut->validate($validMaskedCpf);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - CPF validation with invalid masked CPF.
     * Conditions/Scenarios:
     * - Input is an invalid masked CPF string and validateMask is set to true.
     * Expected results:
     * - Returns false.
     */
    #[Test]
    #[Group('unit')]
    public function testValidateInvalidMaskedCPFReturnsFalse(): void
    {
        // Arrange
        $invalidMaskedCpf = '123.456.789-00';
        $this->sut->setValidateMask(true);

        // Act
        $result = $this->sut->validate($invalidMaskedCpf);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - CPF validation with valid masked CPF but validateMask is false.
     * Conditions/Scenarios:
     * - Input is a valid masked CPF string and validateMask is set to false.
     * Expected results:
     * - Returns true.
     */
    #[Test]
    #[Group('unit')]
    public function testValidateValidMaskedCPFValidateMaskFalseReturnsTrue(): void
    {
        // Arrange
        $validMaskedCpf = '123.456.789-09';
        $this->sut->setValidateMask(false);

        // Act
        $result = $this->sut->validate($validMaskedCpf);

        // Assert
        $this->assertTrue($result);
    }
}
