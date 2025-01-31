<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Unique;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class UniqueTest extends TestCase
{
    private QueryBuilder $queryBuilder;
    private Unique $validator;

    protected function setUp(): void
    {
        $this->queryBuilder = m::mock(QueryBuilder::class);
        $this->validator = new Unique($this->queryBuilder);
    }

    public function testValidateUniqueValueTrue()
    {
        $this->queryBuilder->shouldReceive('from')->andReturnSelf();
        $this->queryBuilder->shouldReceive('where')->andReturnSelf();
        $this->queryBuilder->shouldReceive('count')->andReturn(0);
        $this->validator->setIndex('index')->setField('field');
        $this->assertTrue($this->validator->validate('value'));
    }

    public function testValidateUniqueValueFalse()
    {
        $this->queryBuilder->shouldReceive('from')->andReturnSelf();
        $this->queryBuilder->shouldReceive('where')->andReturnSelf();
        $this->queryBuilder->shouldReceive('count')->andReturn(1);
        $this->validator->setIndex('index')->setField('field');
        $this->assertFalse($this->validator->validate('value'));
    }

    public function testValidateUniqueEntityObjectTrue()
    {
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
        $this->assertTrue($this->validator->validate($value));
    }

    public function testValidateUniqueEntityObjectFalse()
    {
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
        $this->assertFalse($this->validator->validate($value));
    }

    public function testValidateInvalidEntityObject()
    {
        $value = new class {
            public function getIdentifier()
            {
                return 1;
            }
        };

        $this->validator->setIndex('index')->setField('field');
        $this->assertFalse($this->validator->validate($value));
    }

    public function testValidateEmptyValue()
    {
        $this->validator->setIndex('index')->setField('field');
        $this->assertTrue($this->validator->validate(''));
    }
}