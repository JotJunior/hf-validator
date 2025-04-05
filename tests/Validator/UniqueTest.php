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
use Jot\HfValidator\Validator\Unique;
use Mockery as m;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Unique::class)]
class UniqueTest extends TestCase
{
    private QueryBuilder $queryBuilder;

    private Unique $validator;

    protected function setUp(): void
    {
        $this->queryBuilder = m::mock(QueryBuilder::class);
        $this->validator = new Unique($this->queryBuilder);
    }

    /**
     * What is being tested:
     * - Unique validator with a value that doesn't exist in the database
     * Conditions/Scenarios:
     * - Index and field are set
     * - Query returns count of 0 (no matching records)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateUniqueValueTrue(): void
    {
        // Arrange
        $this->queryBuilder->shouldReceive('from')->andReturnSelf();
        $this->queryBuilder->shouldReceive('where')->andReturnSelf();
        $this->queryBuilder->shouldReceive('count')->andReturn(0);
        $this->validator->setIndex('index')->setField('field');
        $testValue = 'value';

        // Act
        $result = $this->validator->validate($testValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Unique validator with a value that already exists in the database
     * Conditions/Scenarios:
     * - Index and field are set
     * - Query returns count of 1 (one matching record)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateUniqueValueFalse(): void
    {
        // Arrange
        $this->queryBuilder->shouldReceive('from')->andReturnSelf();
        $this->queryBuilder->shouldReceive('where')->andReturnSelf();
        $this->queryBuilder->shouldReceive('count')->andReturn(1);
        $this->validator->setIndex('index')->setField('field');
        $testValue = 'value';

        // Act
        $result = $this->validator->validate($testValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Unique validator with an entity object that doesn't exist in the database
     * Conditions/Scenarios:
     * - Entity object with getId() method is provided
     * - Index and field are set
     * - Query returns count of 0 (no matching records)
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateUniqueEntityObjectTrue(): void
    {
        // Arrange
        $value = new class {
            public function getId()
            {
                return 1;
            }
        };

        $this->queryBuilder->shouldReceive('from')->andReturnSelf();
        $this->queryBuilder->shouldReceive('where')->andReturnSelf();
        $this->queryBuilder->shouldReceive('count')->andReturn(0);

        $this->validator->setIndex('index')->setField('field');

        // Act
        $result = $this->validator->validate($value);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Unique validator with an entity object that already exists in the database
     * Conditions/Scenarios:
     * - Entity object with getId() method is provided
     * - Index and field are set
     * - Query returns count of 1 (one matching record)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateUniqueEntityObjectFalse(): void
    {
        // Arrange
        $value = new class {
            public function getId()
            {
                return 1;
            }
        };

        $this->queryBuilder->shouldReceive('from')->andReturnSelf();
        $this->queryBuilder->shouldReceive('where')->andReturnSelf();
        $this->queryBuilder->shouldReceive('count')->andReturn(1);

        $this->validator->setIndex('index')->setField('field');

        // Act
        $result = $this->validator->validate($value);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Unique validator with an invalid entity object
     * Conditions/Scenarios:
     * - Entity object without getId() method is provided (has getIdentifier() instead)
     * - Index and field are set
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateInvalidEntityObject(): void
    {
        // Arrange
        $value = new class {
            public function getIdentifier()
            {
                return 1;
            }
        };

        $this->validator->setIndex('index')->setField('field');

        // Act
        $result = $this->validator->validate($value);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Unique validator with an empty value
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * - Index and field are set
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateEmptyValue(): void
    {
        // Arrange
        $this->validator->setIndex('index')->setField('field');
        $emptyValue = '';

        // Act
        $result = $this->validator->validate($emptyValue);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
