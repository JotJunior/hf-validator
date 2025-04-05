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
use Jot\HfValidator\Validator\Gte;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Gte::class)]
class GteTest extends TestCase
{
    private Gte $gte;

    private QueryBuilder $mockQueryBuilder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockQueryBuilder = $this->createMock(QueryBuilder::class);
        $this->gte = new Gte($this->mockQueryBuilder);
    }

    /**
     * What is being tested:
     * - Gte validator with value greater than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 100
     * - Input value is 101
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateGreaterThan(): void
    {
        // Arrange
        $this->gte->setValue(100);
        $greaterValue = 101;

        // Act
        $result = $this->gte->validate($greaterValue);
        $errors = $this->gte->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Gte validator with value equal to comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 100
     * - Input value is 100
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateEqualTo(): void
    {
        // Arrange
        $this->gte->setValue(100);
        $equalValue = 100;

        // Act
        $result = $this->gte->validate($equalValue);
        $errors = $this->gte->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Gte validator with value lower than comparison value
     * Conditions/Scenarios:
     * - Value to compare against is set to 100
     * - Input value is 99
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateLowerThan(): void
    {
        // Arrange
        $this->gte->setValue(100);
        $lowerValue = 99;

        // Act
        $result = $this->gte->validate($lowerValue);
        $errors = $this->gte->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Gte validator with type mismatch (numeric vs DateTime)
     * Conditions/Scenarios:
     * - Value to compare against is set to numeric 100
     * - Input value is DateTime object
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMismatchNumericDateTime(): void
    {
        // Arrange
        $this->gte->setValue(100);
        $dateTimeValue = new DateTime('now');

        // Act
        $result = $this->gte->validate($dateTimeValue);
        $errors = $this->gte->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Gte validator with type mismatch (DateTime vs numeric)
     * Conditions/Scenarios:
     * - Value to compare against is set to DateTime object
     * - Input value is numeric 100
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateMismatchDateTimeNumeric(): void
    {
        // Arrange
        $this->gte->setValue(new DateTime('now'));
        $numericValue = 100;

        // Act
        $result = $this->gte->validate($numericValue);
        $errors = $this->gte->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Gte validator with empty value
     * Conditions/Scenarios:
     * - Value to compare against is set to 100
     * - Input value is empty string
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateEmpty(): void
    {
        // Arrange
        $this->gte->setValue(100);
        $emptyValue = '';

        // Act
        $result = $this->gte->validate($emptyValue);
        $errors = $this->gte->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
