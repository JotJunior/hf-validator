<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Gt;
use PHPUnit\Framework\TestCase;

final class GtTest extends TestCase
{
    private Gt $validator;
    private \DateTimeInterface $now;
    private float $numericValue;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->validator = new Gt($queryBuilder);
    }

    public function testValidateEmptyValue(): void
    {
        $this->validator->setValue(new \DateTime('-1 day')); // value is yesterday
        $isValid = $this->validator->validate(''); // validate now
        $this->assertTrue($isValid);
        $this->assertEmpty($this->validator->consumeErrors());
    }

    public function testValidateCorrectDateTimeTypeGreaterValue(): void
    {
        $this->validator->setValue(new \DateTime('-1 day')); // value is yesterday
        $isValid = $this->validator->validate(new \DateTime('now')); // validate now
        $this->assertTrue($isValid);
        $this->assertEmpty($this->validator->consumeErrors());
    }

    public function testValidateCorrectDateTimeTypeSmallerValue(): void
    {
        $this->validator->setValue(new \DateTime('+1 day')); // value is tomorrow
        $isValid = $this->validator->validate(new \DateTime('now')); // validate now
        $this->assertFalse($isValid);
    }

    public function testValidateIncorrectDateTimeType(): void
    {
        $this->validator->setValue(new \DateTime('now'));
        $isValid = $this->validator->validate(10);
        $this->assertFalse($isValid);
    }

    public function testValidateCorrectNumericTypeGreaterValue(): void
    {
        $this->validator->setValue(9);
        $isValid = $this->validator->validate(10);
        $this->assertTrue($isValid);
    }

    public function testValidateCorrectNumericTypeSmallerValue(): void
    {
        $this->validator->setValue(10 + 1); // value is 43.0
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