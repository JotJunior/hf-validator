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
use Jot\HfValidator\Validator\Email;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Email::class)]
class EmailTest extends TestCase
{
    private Email $email;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);

        $this->email = new Email($queryBuilder);
    }

    /**
     * What is being tested:
     * - Email validator behavior with empty value
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithEmptyValue(): void
    {
        // Arrange
        $value = '';

        // Act
        $result = $this->email->validate($value);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Email validator behavior with non-string value
     * Conditions/Scenarios:
     * - Numeric value is provided as input
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidString(): void
    {
        // Arrange
        $value = 123;

        // Act
        $result = $this->email->validate($value);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - Email validator with domain checking enabled
     * Conditions/Scenarios:
     * - Valid email with resolvable domain is provided
     * - Domain checking is enabled
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithResolvedDomain(): void
    {
        // Arrange
        $this->email->setCheckDomain(true);
        $email = 'jot@jot.com.br';

        // Act
        $result = $this->email->validate($email);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Email validator with invalid email format
     * Conditions/Scenarios:
     * - String without @ symbol is provided
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidEmail(): void
    {
        // Arrange
        $invalidEmail = 'invalidEmail';

        // Act
        $result = $this->email->validate($invalidEmail);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - Email validator with domain checking enabled and invalid email
     * Conditions/Scenarios:
     * - Invalid email format is provided
     * - Domain checking is enabled
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidDomain(): void
    {
        // Arrange
        $this->email->setCheckDomain(true);
        $invalidEmail = 'invalidEmail';

        // Act
        $result = $this->email->validate($invalidEmail);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - Email validator with valid email format
     * Conditions/Scenarios:
     * - Valid email address is provided
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidEmail(): void
    {
        // Arrange
        $validEmail = 'tester@gmail.com';

        // Act
        $result = $this->email->validate($validEmail);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Email validator with domain checking and valid email
     * Conditions/Scenarios:
     * - Valid email with resolvable domain is provided
     * - Domain checking is enabled
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidEmailAndCheckDomainEnabled(): void
    {
        // Arrange
        $this->email->setCheckDomain(true);
        $validEmail = 'tester@gmail.com';

        // Act
        $result = $this->email->validate($validEmail);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Email validator with domain checking and non-existent domain
     * Conditions/Scenarios:
     * - Email with non-existent domain is provided
     * - Domain checking is enabled
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInValidEmailAndCheckDomainEnabled(): void
    {
        // Arrange
        $this->email->setCheckDomain(true);
        $emailWithNonExistentDomain = 'tester@nonexistentmaildomain.co.xpto';

        // Act
        $result = $this->email->validate($emailWithNonExistentDomain);

        // Assert
        $this->assertFalse($result);
    }
}
