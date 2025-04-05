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
use Jot\HfValidator\Validator\Enum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Enum::class)]
class EnumTest extends TestCase
{
    protected Enum $enum;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->enum = new Enum($queryBuilder);
        $this->enum->setValues(['apple', 'banana', 'cherry']);
    }

    /**
     * What is being tested:
     * - Enum validator with value that exists in allowed values
     * Conditions/Scenarios:
     * - Value 'apple' is in the allowed values list
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateExists(): void
    {
        // Arrange
        $validValue = 'apple';

        // Act
        $result = $this->enum->validate($validValue);
        $errors = $this->enum->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Enum validator with value that does not exist in allowed values
     * Conditions/Scenarios:
     * - Value 'pineapple' is not in the allowed values list
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateDoesNotExist(): void
    {
        // Arrange
        $invalidValue = 'pineapple';

        // Act
        $result = $this->enum->validate($invalidValue);
        $errors = $this->enum->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Enum validator with empty value
     * Conditions/Scenarios:
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
        $emptyValue = '';

        // Act
        $result = $this->enum->validate($emptyValue);
        $errors = $this->enum->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
