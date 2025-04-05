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
use Jot\HfValidator\Validator\Required;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
#[CoversClass(Required::class)]
class RequiredTest extends TestCase
{
    private Required $required;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->required = new Required($queryBuilder);
    }

    /**
     * What is being tested:
     * - Required validator with valid data
     * Conditions/Scenarios:
     * - Various valid values are provided (strings, numbers, objects)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('validDataProvider')]
    public function testValidateWithValidData($value): void
    {
        // Arrange - Data is provided by the data provider

        // Act
        $result = $this->required->validate($value);
        $errors = $this->required->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Required validator with valid data in create mode
     * Conditions/Scenarios:
     * - Various valid values are provided (strings, numbers, objects)
     * - Validator is set to onCreate mode
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('validDataProvider')]
    public function testValidateWithValidDataOnCreate($value): void
    {
        // Arrange
        $this->required->setOnCreate(true)->setOnUpdate(false);

        // Act
        $result = $this->required->onCreate()->validate($value);
        $errors = $this->required->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Required validator with valid data in update mode
     * Conditions/Scenarios:
     * - Various valid values are provided (strings, numbers, objects)
     * - Validator is set to onUpdate mode
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('validDataProvider')]
    public function testValidateWithValidDataOnUpdate($value): void
    {
        // Arrange
        $this->required->setOnCreate(false)->setOnUpdate(true);

        // Act
        $result = $this->required->onUpdate()->validate($value);
        $errors = $this->required->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Required validator with invalid data
     * Conditions/Scenarios:
     * - Various invalid values are provided (empty string, whitespace, null)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('invalidDataProvider')]
    public function testValidateWithInvalidData($value): void
    {
        // Arrange - Data is provided by the data provider

        // Act
        $result = $this->required->validate($value);
        $errors = $this->required->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Required validator with invalid data in create mode
     * Conditions/Scenarios:
     * - Various invalid values are provided (empty string, whitespace, null)
     * - Validator is set to onCreate mode
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('invalidDataProvider')]
    public function testValidateWithInvalidDataOnCreate($value): void
    {
        // Arrange
        $this->required->setOnCreate(true)->setOnUpdate(false);

        // Act
        $result = $this->required->onCreate()->validate($value);
        $errors = $this->required->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Required validator with invalid data in update mode
     * Conditions/Scenarios:
     * - Various invalid values are provided (empty string, whitespace, null)
     * - Validator is set to onUpdate mode
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('invalidDataProvider')]
    public function testValidateWithInvalidDataOnUpdate($value): void
    {
        // Arrange
        $this->required->setOnCreate(false)->setOnUpdate(true);

        // Act
        $result = $this->required->onUpdate()->validate($value);
        $errors = $this->required->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Required validator with an object that has a null ID
     * Conditions/Scenarios:
     * - An anonymous class with getId() method that returns null is provided
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testIsInvalidObject(): void
    {
        // Arrange
        $object = new class {
            public function getId()
            {
                return null;
            }
        };

        // Act
        $result = $this->required->validate($object);
        $errors = $this->required->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * Data provider for valid data tests.
     */
    public static function validDataProvider(): array
    {
        return [
            ['A valid string'],
            [123456],
            [1.23456],
            [new stdClass()],
        ];
    }

    /**
     * Data provider for invalid data tests.
     */
    public static function invalidDataProvider(): array
    {
        return [
            [''],
            [' '],
            [null],
        ];
    }
}
