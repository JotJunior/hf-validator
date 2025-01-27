<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Regex;
use PHPUnit\Framework\TestCase;

/**
 * Class RegexTest
 * Tests for the `validate` method in the `Regex` class.
 */
class RegexTest extends TestCase
{
    private Regex $regex;

    protected function setUp(): void
    {
        parent::setUp();

        $this->regex = new Regex('/^[0-9]+$/');
    }

    /**
     * Test to validate a numeric value.
     */
    public function testValidateNumericValue(): void
    {
        $this->assertTrue($this->regex->validate('1234'));
    }

    /**
     * Test to validate a non-numeric value.
     */
    public function testValidateNonNumericValue(): void
    {
        $this->assertFalse($this->regex->validate('abcd'));
    }

    /**
     * Test to validate an empty value.
     */
    public function testValidateEmptyValue(): void
    {
        $this->assertFalse($this->regex->validate(''));
    }
}