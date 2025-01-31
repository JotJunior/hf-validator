<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Lte;
use PHPUnit\Framework\TestCase;

/**
 * Class LteTest
 * Tests the Lte class in the HfValidator component.
 */
class LteTest extends TestCase
{
    /** @var Lte $lte */
    private Lte $lte;
    private QueryBuilder $mockQueryBuilder;

    protected function setUp(): void
    {
        $this->mockQueryBuilder = $this->createMock(QueryBuilder::class);
        $this->lte = new Lte($this->mockQueryBuilder);
    }

    public function testValidateGreaterThan(): void
    {
        $this->lte->setValue(100);
        $this->assertFalse($this->lte->validate(101));
        $this->assertNotEmpty($this->lte->consumeErrors());
    }

    public function testValidateEqualTo(): void
    {
        $this->lte->setValue(100);
        $this->assertTrue($this->lte->validate(100));
        $this->assertEmpty($this->lte->consumeErrors());
    }

    public function testValidateLowerThan(): void
    {
        $this->lte->setValue(100);
        $this->assertTrue($this->lte->validate(99));
        $this->assertEmpty($this->lte->consumeErrors());
    }

    public function testValidateMismatchNumericDateTime(): void
    {
        $this->lte->setValue(100);
        $this->assertFalse($this->lte->validate(new \DateTime('now')));
        $this->assertNotEmpty($this->lte->consumeErrors());
    }

    public function testValidateMismatchDateTimeNumeric(): void
    {
        $this->lte->setValue(new \DateTime('now'));
        $this->assertFalse($this->lte->validate(100));
        $this->assertNotEmpty($this->lte->consumeErrors());
    }

    public function testValidateEmpty(): void
    {
        $this->lte->setValue(100);
        $this->assertTrue($this->lte->validate(''));
        $this->assertEmpty($this->lte->consumeErrors());
    }

}