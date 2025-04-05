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
use Jot\HfValidator\Validator\Lt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Lt::class)]
final class LtTest extends TestCase
{
    private Lt $validator;

    private DateTimeInterface $now;

    private float $numericValue;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->validator = new Lt($queryBuilder);
    }

    /**
     * What is being tested:
     * - Lt validator with empty value
     * Conditions/Scenarios:
     * - Value to compare against is set to current date
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
        $this->validator->setValue(new DateTime('now'));
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
     * - Lt validator with DateTime value lower than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 2 days in the future
     * - Current date is provided as input
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateCorrectDateTimeTypeLowerValue(): void
    {
        // Arrange
        $this->validator->setValue(new DateTime('+2 days'));
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
     * - Lt validator with DateTime value greater than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 1 day in the past
     * - Current date is provided as input
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateCorrectDateTimeTypeGreaterValue(): void
    {
        // Arrange
        $this->validator->setValue(new DateTime('-1 day'));
        $currentDate = new DateTime('now');

        // Act
        $isValid = $this->validator->validate($currentDate);

        // Assert
        $this->assertFalse($isValid);
    }

    /**
     * What is being tested:
     * - Lt validator with incorrect type (numeric instead of DateTime)
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
     * - Lt validator with numeric value lower than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 11
     * - Input value is 10
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateCorrectNumericTypeLowerValue(): void
    {
        // Arrange
        $this->validator->setValue(11);
        $lowerValue = 10;

        // Act
        $isValid = $this->validator->validate($lowerValue);

        // Assert
        $this->assertTrue($isValid);
    }

    /**
     * What is being tested:
     * - Lt validator with numeric value greater than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 9
     * - Input value is 10
     * Expected results:
     * - Validation fails (returns false)
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
        $this->assertFalse($isValid);
    }

    /**
     * What is being tested:
     * - Lt validator with incorrect type (DateTime instead of numeric)
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
