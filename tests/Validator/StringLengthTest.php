<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\StringLength;
use PHPUnit\Framework\TestCase;

class StringLengthTest extends TestCase
{
    private $stringValidator;

    protected QueryBuilder $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = $this->createMock(QueryBuilder::class);
    }

    public function testStringLessThanMinLength(): void
    {
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMin(5);
        $this->assertFalse($stringValidator->validate("1234"));
    }

    public function testStringGreaterThanMaxLength(): void
    {
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMax(5);
        $this->assertFalse($stringValidator->validate("123456"));
    }

    public function testStringWithinMinMaxLength(): void
    {
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMin(3)->setMax(5);
        $this->assertTrue($stringValidator->validate("1234"));
    }

    public function testStringOnMinBoundary(): void
    {
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMin(5);
        $this->assertTrue($stringValidator->validate("12345"));
    }

    public function testStringOnMaxBoundary(): void
    {
        $stringValidator = new StringLength($this->queryBuilder);
        $stringValidator->setMax(5);
        $this->assertTrue($stringValidator->validate("12345"));
    }

    public function testNonStringInputNotValid(): void
    {
        $stringValidator = new StringLength($this->queryBuilder);
        $this->assertFalse($stringValidator->validate(12345));
    }

    public function testEmptyStringIsValid(): void
    {
        $stringValidator = new StringLength($this->queryBuilder);
        $this->assertTrue($stringValidator->validate(""));
    }
}