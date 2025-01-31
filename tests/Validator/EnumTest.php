<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Enum;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{

    protected Enum $enum;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->enum = new Enum($queryBuilder);
        $this->enum->setValues(['apple', 'banana', 'cherry']);
    }

    public function testValidateExists(): void
    {
        $this->assertTrue($this->enum->validate('apple'));
        $this->assertEmpty($this->enum->consumeErrors());
    }

    public function testValidateDoesNotExist(): void
    {
        $this->assertFalse($this->enum->validate('pineapple'));
        $this->assertNotEmpty($this->enum->consumeErrors());
    }

    public function testValidateEmptyValue(): void
    {
        $this->assertTrue($this->enum->validate(''));
        $this->assertEmpty($this->enum->consumeErrors());
    }

}