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
use Jot\HfValidator\Validator\Exists;
use Mockery as m;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
#[CoversClass(Exists::class)]
class ExistsTest extends TestCase
{
    protected Exists $validator;

    protected $queryBuilder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->queryBuilder = m::mock(QueryBuilder::class);
        $this->validator = new Exists($this->queryBuilder);
    }

    /**
     * What is being tested:
     * - Exists validator with empty value
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithEmptyValue(): void
    {
        // Arrange
        $emptyValue = '';

        // Act
        $result = $this->validator->validate($emptyValue);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Exists validator with invalid entity type
     * Conditions/Scenarios:
     * - Standard class object without getId method is provided
     * Expected results:
     * - Validation fails (returns false)
     * - Error message for invalid entity is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidEntity(): void
    {
        // Arrange
        $invalidEntity = new stdClass();

        // Act
        $result = $this->validator->validate($invalidEntity);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertContains(Exists::ERROR_INVALID_ENTITY, $errors);
    }

    /**
     * What is being tested:
     * - Exists validator with entity that doesn't exist in database
     * Conditions/Scenarios:
     * - Entity with getId method is provided
     * - QueryBuilder returns count of 0 (no matching records)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message for non-existent value is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValueDoesNotExist(): void
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

        $this->validator->setIndex('users')->setField('id');

        // Act
        $result = $this->validator->validate($value);
        $errors = $this->validator->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertContains(Exists::ERROR_VALUE_DOES_NOT_EXIST, $errors);
    }

    /**
     * What is being tested:
     * - Exists validator with entity that exists in database
     * Conditions/Scenarios:
     * - Entity with getId method is provided
     * - QueryBuilder returns count of 1 (record exists)
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValueExists(): void
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

        $this->validator->setIndex('users')->setField('id');

        // Act
        $result = $this->validator->validate($value);

        // Assert
        $this->assertTrue($result);
    }
}
