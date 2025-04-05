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
use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Range;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Range::class)]
class RangeTest extends TestCase
{
    private Range $range;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->range = new Range($queryBuilder);
    }

    /**
     * What is being tested:
     * - Range validator with a number between valid min and max values
     * Conditions/Scenarios:
     * - Min value set to 2.5
     * - Max value set to 5.5
     * - Input value is 4 (within range)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMethodBetweenValidNumberRange(): void
    {
        // Arrange
        $this->range->setMin(2.5)->setMax(5.5);
        $valueWithinRange = 4;

        // Act
        $result = $this->range->validate($valueWithinRange);
        $errors = $this->range->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Range validator with a number outside valid min and max values
     * Conditions/Scenarios:
     * - Min value set to 2.5
     * - Max value set to 5.5
     * - Input value is 6 (outside range)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMethodOutOfRange(): void
    {
        // Arrange
        $this->range->setMin(2.5)->setMax(5.5);
        $valueOutsideRange = 6;

        // Act
        $result = $this->range->validate($valueOutsideRange);
        $errors = $this->range->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Range validator with a date between valid min and max dates
     * Conditions/Scenarios:
     * - Min date set to 2021-01-01
     * - Max date set to 2022-01-01
     * - Input date is 2021-06-01 (within range)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMethodBetweenValidDateRange(): void
    {
        // Arrange
        $minDate = new DateTime('2021-01-01');
        $maxDate = new DateTime('2022-01-01');
        $dateWithinRange = new DateTime('2021-06-01');
        $this->range->setMin($minDate)->setMax($maxDate);

        // Act
        $result = $this->range->validate($dateWithinRange);
        $errors = $this->range->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Range validator with a date outside valid min and max dates
     * Conditions/Scenarios:
     * - Min date set to 2021-01-01
     * - Max date set to 2022-01-01
     * - Input date is 2020-06-01 (before min date)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMethodDateOutOfRange(): void
    {
        // Arrange
        $minDate = new DateTime('2021-01-01');
        $maxDate = new DateTime('2022-01-01');
        $dateOutsideRange = new DateTime('2020-06-01');
        $this->range->setMin($minDate)->setMax($maxDate);

        // Act
        $result = $this->range->validate($dateOutsideRange);
        $errors = $this->range->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Range validator with mismatched types (numeric range with date input)
     * Conditions/Scenarios:
     * - Min value set to 2.5 (numeric)
     * - Max value set to 8 (numeric)
     * - Input value is a DateTime object
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMethodInvalidMixOfNumberAndDateRange(): void
    {
        // Arrange
        $this->range->setMin(2.5)->setMax(8);
        $dateValue = new DateTime('now');

        // Act
        $result = $this->range->validate($dateValue);
        $errors = $this->range->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Range validator with mismatched types (date range with numeric input)
     * Conditions/Scenarios:
     * - Min value set to current date
     * - Max value set to 5 days from now
     * - Input value is numeric (4)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMethodInvalidMixOfDateAndNumberRange(): void
    {
        // Arrange
        $minDate = new DateTime('now');
        $maxDate = new DateTime('+5 days');
        $numericValue = 4;
        $this->range->setMin($minDate)->setMax($maxDate);

        // Act
        $result = $this->range->validate($numericValue);
        $errors = $this->range->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Range validator with empty value
     * Conditions/Scenarios:
     * - Min value set to 2.5
     * - Max value set to 5.5
     * - Input value is null
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMethodEmptyValue(): void
    {
        // Arrange
        $this->range->setMin(2.5)->setMax(5.5);
        $emptyValue = null;

        // Act
        $result = $this->range->validate($emptyValue);
        $errors = $this->range->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
