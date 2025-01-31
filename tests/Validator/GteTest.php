<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Gte;
use PHPUnit\Framework\TestCase;

/**
 * Class GteTest
 * Tests the Gte class in the HfValidator component.
 */
class GteTest extends TestCase
{
    /** @var Gte $gte */
    private Gte $gte;
    private QueryBuilder $mockQueryBuilder;

    protected function setUp(): void
    {
        $this->mockQueryBuilder = $this->createMock(QueryBuilder::class);
        $this->gte = new Gte($this->mockQueryBuilder);
    }

    public function testValidateGreaterThan(): void
    {
        $this->gte->setValue(100);
        $this->assertTrue($this->gte->validate(101));
        $this->assertEmpty($this->gte->consumeErrors());
    }

    public function testValidateEqualTo(): void
    {
        $this->gte->setValue(100);
        $this->assertTrue($this->gte->validate(100));
        $this->assertEmpty($this->gte->consumeErrors());
    }

    public function testValidateLowerThan(): void
    {
        $this->gte->setValue(100);
        $this->assertFalse($this->gte->validate(99));
        $this->assertNotEmpty($this->gte->consumeErrors());
    }

    public function testValidateMismatchNumericDateTime(): void
    {
        $this->gte->setValue(100);
        $this->assertFalse($this->gte->validate(new \DateTime('now')));
        $this->assertNotEmpty($this->gte->consumeErrors());
    }

    public function testValidateMismatchDateTimeNumeric(): void
    {
        $this->gte->setValue(new \DateTime('now'));
        $this->assertFalse($this->gte->validate(100));
        $this->assertNotEmpty($this->gte->consumeErrors());
    }

    public function testValidateEmpty(): void
    {
        $this->gte->setValue(100);
        $this->assertTrue($this->gte->validate(''));
        $this->assertEmpty($this->gte->consumeErrors());
    }

}