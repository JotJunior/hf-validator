<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Lt;
use PHPUnit\Framework\TestCase;

final class LtTest extends TestCase
{
    private Lt $validator;
    private \DateTimeInterface $now;
    private float $numericValue;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->validator = new Lt($queryBuilder);
    }

    public function testValidateEmptyValue(): void
    {
        $this->validator->setValue(new \DateTime('now')); // value is yesterday
        $isValid = $this->validator->validate(''); // validate now
        $this->assertTrue($isValid);
        $this->assertEmpty($this->validator->consumeErrors());
    }

    public function testValidateCorrectDateTimeTypeLowerValue(): void
    {
        $this->validator->setValue(new \DateTime('+2 days')); // value is yesterday
        $isValid = $this->validator->validate(new \DateTime('now')); // validate now
        $this->assertTrue($isValid);
        $this->assertEmpty($this->validator->consumeErrors());
    }

    public function testValidateCorrectDateTimeTypeGreaterValue(): void
    {
        $this->validator->setValue(new \DateTime('-1 day')); // value is tomorrow
        $isValid = $this->validator->validate(new \DateTime('now')); // validate now
        $this->assertFalse($isValid);
    }

    public function testValidateIncorrectDateTimeType(): void
    {
        $this->validator->setValue(new \DateTime('now'));
        $isValid = $this->validator->validate(10);
        $this->assertFalse($isValid);
    }

    public function testValidateCorrectNumericTypeLowerValue(): void
    {
        $this->validator->setValue(11);
        $isValid = $this->validator->validate(10);
        $this->assertTrue($isValid);
    }

    public function testValidateCorrectNumericTypeGreaterValue(): void
    {
        $this->validator->setValue(9); // value is 43.0
        $isValid = $this->validator->validate(10); // validate 42.0
        $this->assertFalse($isValid);
    }

    public function testValidateIncorrectNumericType(): void
    {
        $this->validator->setValue(10);
        $isValid = $this->validator->validate(new \DateTime('now'));
        $this->assertFalse($isValid);
    }
}