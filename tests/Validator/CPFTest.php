<?php

declare(strict_types=1);

namespace Jot\HfValidator\Test\Validator;

use Jot\HfValidator\Validator\CPF;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;

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
    public function testValidate_ValidCPF_ReturnsTrue(): void
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
    public function testValidate_InvalidCPF_ReturnsFalse(): void
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
    public function testValidate_EmptyCPF_ReturnsTrue(): void
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
    public function testValidate_NonStringCPF_ReturnsFalse(): void
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
    public function testValidate_ValidMaskedCPF_ReturnsTrue(): void
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
    public function testValidate_InvalidMaskedCPF_ReturnsFalse(): void
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
    public function testValidate_ValidMaskedCPFValidateMaskFalse_ReturnsTrue(): void
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
