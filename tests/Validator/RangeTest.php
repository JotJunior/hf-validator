<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Range;
use PHPUnit\Framework\TestCase;

class RangeTest extends TestCase
{
    public function testValidateMethod(): void
    {
        $range = new Range(1, 10);

        // Test with value within the range.
        $value = 5;
        $this->assertTrue($range->validate($value));

        // Test with value below the range.
        $value = 0;
        $this->assertFalse($range->validate($value));

        // Test with value above the range.
        $value = 11;
        $this->assertFalse($range->validate($value));

        // Test with non-numeric value.
        $value = 'a';
        $this->assertFalse($range->validate($value));

        // Test boundary values
        $this->assertTrue($range->validate(1));
        $this->assertTrue($range->validate(10));
    }
}