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
use Jot\HfValidator\Validator\Password;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Password::class)]
class PasswordTest extends TestCase
{
    protected Password $password;

    protected function setUp(): void
    {
        parent::setUp();
        $mockQueryBuilder = $this->createMock(QueryBuilder::class);
        $this->password = new Password($mockQueryBuilder);
        $this->password
            ->setRequireLower(true)
            ->setRequireUpper(true)
            ->setRequireNumber(true)
            ->setRequireSpecial(true)
            ->setSpecial('@#$')
            ->setMinLength(5)
            ->setMaxLength(10);
    }

    /**
     * What is being tested:
     * - Password validator with empty password
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithEmptyPassword(): void
    {
        // Arrange
        $emptyPassword = '';

        // Act
        $result = $this->password->validate($emptyPassword);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Password validator with password shorter than minimum length
     * Conditions/Scenarios:
     * - Password with 4 characters is provided (minimum is 5)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithShortPassword(): void
    {
        // Arrange
        $shortPassword = '1234';

        // Act
        $result = $this->password->validate($shortPassword);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Password validator with password longer than maximum length
     * Conditions/Scenarios:
     * - Password with 15 characters is provided (maximum is 10)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithLongPassword(): void
    {
        // Arrange
        $longPassword = '123451234512345';

        // Act
        $result = $this->password->validate($longPassword);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Password validator with valid password meeting all requirements
     * Conditions/Scenarios:
     * - Password contains lowercase, uppercase, numbers, and special characters
     * - Password length is within allowed range
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidPassword(): void
    {
        // Arrange
        $validPassword = 'abAB12@#$';

        // Act
        $result = $this->password->validate($validPassword);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Password validator with password missing lowercase characters
     * Conditions/Scenarios:
     * - Password contains uppercase, numbers, and special characters but no lowercase
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithMissingLowerPassword(): void
    {
        // Arrange
        $passwordWithoutLower = 'AB12@#$';

        // Act
        $result = $this->password->validate($passwordWithoutLower);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Password validator with password missing uppercase characters
     * Conditions/Scenarios:
     * - Password contains lowercase, numbers, and special characters but no uppercase
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithMissingUpperPassword(): void
    {
        // Arrange
        $passwordWithoutUpper = 'ab12@#$';

        // Act
        $result = $this->password->validate($passwordWithoutUpper);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Password validator with password missing numeric characters
     * Conditions/Scenarios:
     * - Password contains lowercase, uppercase, and special characters but no numbers
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithMissingNumberPassword(): void
    {
        // Arrange
        $passwordWithoutNumber = 'abAB@#$';

        // Act
        $result = $this->password->validate($passwordWithoutNumber);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Password validator with password missing special characters
     * Conditions/Scenarios:
     * - Password contains lowercase, uppercase, and numbers but no special characters
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithMissingSpecialCharPassword(): void
    {
        // Arrange
        $passwordWithoutSpecial = 'abAB123';

        // Act
        $result = $this->password->validate($passwordWithoutSpecial);
        $errors = $this->password->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }
}
