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

use DateTime;
use DateTimeInterface;
use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Gt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Gt::class)]
final class GtTest extends TestCase
{
    private Gt $validator;

    private DateTimeInterface $now;

    private float $numericValue;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->validator = new Gt($queryBuilder);
    }

    /**
     * What is being tested:
     * - Gt validator with empty value
     * Conditions/Scenarios:
     * - Value to compare against is set to yesterday
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateEmptyValue(): void
    {
        // Arrange
        $this->validator->setValue(new DateTime('-1 day')); // value is yesterday
        $emptyValue = '';

        // Act
        $isValid = $this->validator->validate($emptyValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($isValid);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Gt validator with DateTime value greater than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to yesterday
     * - Current date is provided as input
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateCorrectDateTimeTypeGreaterValue(): void
    {
        // Arrange
        $this->validator->setValue(new DateTime('-1 day')); // value is yesterday
        $currentDate = new DateTime('now');

        // Act
        $isValid = $this->validator->validate($currentDate);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($isValid);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Gt validator with DateTime value smaller than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to tomorrow
     * - Current date is provided as input
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateCorrectDateTimeTypeSmallerValue(): void
    {
        // Arrange
        $this->validator->setValue(new DateTime('+1 day')); // value is tomorrow
        $currentDate = new DateTime('now');

        // Act
        $isValid = $this->validator->validate($currentDate);

        // Assert
        $this->assertFalse($isValid);
    }

    /**
     * What is being tested:
     * - Gt validator with incorrect type (numeric instead of DateTime)
     * Conditions/Scenarios:
     * - Value to compare against is set to current date
     * - Numeric value is provided as input
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateIncorrectDateTimeType(): void
    {
        // Arrange
        $this->validator->setValue(new DateTime('now'));
        $numericValue = 10;

        // Act
        $isValid = $this->validator->validate($numericValue);

        // Assert
        $this->assertFalse($isValid);
    }

    /**
     * What is being tested:
     * - Gt validator with numeric value greater than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 9
     * - Input value is 10
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateCorrectNumericTypeGreaterValue(): void
    {
        // Arrange
        $this->validator->setValue(9);
        $greaterValue = 10;

        // Act
        $isValid = $this->validator->validate($greaterValue);

        // Assert
        $this->assertTrue($isValid);
    }

    /**
     * What is being tested:
     * - Gt validator with numeric value smaller than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 11 (10 + 1)
     * - Input value is 10
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateCorrectNumericTypeSmallerValue(): void
    {
        // Arrange
        $this->validator->setValue(10 + 1); // value is 11
        $smallerValue = 10;

        // Act
        $isValid = $this->validator->validate($smallerValue);

        // Assert
        $this->assertFalse($isValid);
    }

    /**
     * What is being tested:
     * - Gt validator with incorrect type (DateTime instead of numeric)
     * Conditions/Scenarios:
     * - Value to compare against is set to 10
     * - DateTime value is provided as input
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateIncorrectNumericType(): void
    {
        // Arrange
        $this->validator->setValue(10);
        $dateTimeValue = new DateTime('now');

        // Act
        $isValid = $this->validator->validate($dateTimeValue);

        // Assert
        $this->assertFalse($isValid);
    }
}
