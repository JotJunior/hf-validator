<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Exists;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ExistsTest extends TestCase
{
    protected Exists $validator;
    protected $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = m::mock(QueryBuilder::class);
        $this->validator = new Exists($this->queryBuilder);
    }

    public function testValidateWithEmptyValue(): void
    {
        $this->assertTrue($this->validator->validate(''));
    }

    public function testValidateWithInvalidEntity(): void
    {
        $this->assertFalse($this->validator->validate(new \stdClass()));
        $this->assertContains(Exists::ERROR_INVALID_ENTITY, $this->validator->consumeErrors());
    }

    public function testValidateWithValueDoesNotExist(): void
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

        $this->validator->setIndex('users')->setField('id');
        $this->assertFalse($this->validator->validate($value));
        $this->assertContains(Exists::ERROR_VALUE_DOES_NOT_EXIST, $this->validator->consumeErrors());
    }

    public function testValidateWithValueExists(): void
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

        $this->validator->setIndex('users')->setField('id');
        $this->assertTrue($this->validator->validate($value));
    }
}