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
use Jot\HfValidator\Validator\StringLength;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(StringLength::class)]
class StringLengthTest extends TestCase
{
    protected QueryBuilder $queryBuilder;

    private StringLength $stringValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->queryBuilder = $this->createMock(QueryBuilder::class);
    }

    /**
     * What is being tested:
     * - StringLength validator with a string shorter than minimum length
     * Conditions/Scenarios:
     * - Minimum length set to 5
     * - Input string has length 4
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testStringLessThanMinLength(): void
    {
        // Arrange
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMin(5);
        $shortString = '1234';

        // Act
        $result = $stringValidator->validate($shortString);
        $errors = $stringValidator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - StringLength validator with a string longer than maximum length
     * Conditions/Scenarios:
     * - Maximum length set to 5
     * - Input string has length 6
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testStringGreaterThanMaxLength(): void
    {
        // Arrange
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMax(5);
        $longString = '123456';

        // Act
        $result = $stringValidator->validate($longString);
        $errors = $stringValidator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - StringLength validator with a string within min and max length
     * Conditions/Scenarios:
     * - Minimum length set to 3
     * - Maximum length set to 5
     * - Input string has length 4 (within range)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testStringWithinMinMaxLength(): void
    {
        // Arrange
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMin(3)->setMax(5);
        $validString = '1234';

        // Act
        $result = $stringValidator->validate($validString);
        $errors = $stringValidator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - StringLength validator with a string exactly at minimum length
     * Conditions/Scenarios:
     * - Minimum length set to 5
     * - Input string has length 5 (exactly at minimum)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testStringOnMinBoundary(): void
    {
        // Arrange
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMin(5);
        $exactMinString = '12345';

        // Act
        $result = $stringValidator->validate($exactMinString);
        $errors = $stringValidator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - StringLength validator with a string exactly at maximum length
     * Conditions/Scenarios:
     * - Maximum length set to 5
     * - Input string has length 5 (exactly at maximum)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testStringOnMaxBoundary(): void
    {
        // Arrange
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMax(5);
        $exactMaxString = '12345';

        // Act
        $result = $stringValidator->validate($exactMaxString);
        $errors = $stringValidator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - StringLength validator with a non-string input
     * Conditions/Scenarios:
     * - Input is a number (12345) instead of a string
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testNonStringInputNotValid(): void
    {
        // Arrange
        $stringValidator = new StringLength($this->queryBuilder);
        $nonStringValue = 12345;

        // Act
        $result = $stringValidator->validate($nonStringValue);
        $errors = $stringValidator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - StringLength validator with an empty string
     * Conditions/Scenarios:
     * - Input is an empty string
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testEmptyStringIsValid(): void
    {
        // Arrange
        $stringValidator = new StringLength($this->queryBuilder);
        $emptyString = '';

        // Act
        $result = $stringValidator->validate($emptyString);
        $errors = $stringValidator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
