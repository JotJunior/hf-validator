<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Range;
use PHPUnit\Framework\TestCase;

class RangeTest extends TestCase
{

    protected Range $range;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->range = new Range($queryBuilder);
    }

    public function testValidateMethodBetweenValidNumberRange(): void
    {
        $this->range->setMin(2.5)->setMax(5.5);
        $this->assertTrue($this->range->validate(4));
        $this->assertEmpty($this->range->consumeErrors());
    }

    public function testValidateMethodOutOfRange(): void
    {
        $this->range->setMin(2.5)->setMax(5.5);
        $this->assertFalse($this->range->validate(6));
        $this->assertNotEmpty($this->range->consumeErrors());
    }

    public function testValidateMethodBetweenValidDateRange(): void
    {
        $this->range->setMin(new \DateTime('2021-01-01'))->setMax(new \DateTime('2022-01-01'));
        $this->assertTrue($this->range->validate(new \DateTime('2021-06-01')));
        $this->assertEmpty($this->range->consumeErrors());
    }

    public function testValidateMethodDateOutOfRange(): void
    {
        $this->range->setMin(new \DateTime('2021-01-01'))->setMax(new \DateTime('2022-01-01'));
        $this->assertFalse($this->range->validate(new \DateTime('2020-06-01')));
        $this->assertNotEmpty($this->range->consumeErrors());
    }

    public function testValidateMethodInvalidMixOfNumberAndDateRange(): void
    {
        $this->range->setMin(2.5)->setMax(8);
        $this->assertFalse($this->range->validate(new \DateTime('now')));
        $this->assertNotEmpty($this->range->consumeErrors());
    }

    public function testValidateMethodInvalidMixOfDateAndNumberRange(): void
    {
        $this->range->setMin(new \DateTime('now'))->setMax(new \DateTime('+5 days'));
        $this->assertFalse($this->range->validate(4));
        $this->assertNotEmpty($this->range->consumeErrors());
    }

    public function testValidateMethodEmptyValue(): void
    {
        $this->range->setMin(2.5)->setMax(5.5);
        $this->assertTrue($this->range->validate(null));
        $this->assertEmpty($this->range->consumeErrors());
    }
}