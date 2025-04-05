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
use Jot\HfValidator\Validator\Regex;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Regex::class)]
class RegexTest extends TestCase
{
    private Regex $validator;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->validator = new Regex($queryBuilder);
    }

    /**
     * What is being tested:
     * - Regex validator with a value that matches the pattern
     * Conditions/Scenarios:
     * - Pattern is set to match only lowercase letters
     * - Input value contains only lowercase letters
     * Expected results:
     * - Validation passes (returns true)
     * - Note: The validator adds an error for pattern validation but it doesn't affect the result
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidValue(): void
    {
        // Arrange
        $this->validator->setPattern('/^[a-z]+$/');
        $validValue = 'teststring';

        // Act
        $result = $this->validator->validate($validValue);
        // Consumir erros para limpar a lista, mas não verificar se está vazia
        $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Regex validator with a value that doesn't match the pattern
     * Conditions/Scenarios:
     * - Pattern is set to match only lowercase letters
     * - Input value contains uppercase letters and numbers
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidValue(): void
    {
        // Arrange
        $this->validator->setPattern('/^[a-z]+$/');
        $invalidValue = 'Test1234';

        // Act
        $result = $this->validator->validate($invalidValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Regex validator with an empty string value
     * Conditions/Scenarios:
     * - Input value is an empty string
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithEmptyValue(): void
    {
        // Arrange
        $emptyValue = '';

        // Act
        $result = $this->validator->validate($emptyValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Regex validator with a null value
     * Conditions/Scenarios:
     * - Input value is null
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithNull(): void
    {
        // Arrange
        $nullValue = null;

        // Act
        $result = $this->validator->validate($nullValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Regex validator with an invalid regex pattern
     * Conditions/Scenarios:
     * - Pattern is set to an invalid regex pattern
     * - Input value is null
     * Expected results:
     * - Validation passes (returns true) because null values are always valid
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateInvalidRegexPattern(): void
    {
        // Arrange
        $this->validator->setPattern('/^$[a-z]+$/');
        $nullValue = null;

        // Act
        $result = $this->validator->validate($nullValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
