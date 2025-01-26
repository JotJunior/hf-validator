<?php

namespace Jot\HfValidatorTest\Validators;

use Jot\HfValidator\Validator\CPF;
use PHPUnit\Framework\TestCase;

/**
 * Test class for CPF class.
 */
class CPFTest extends TestCase
{
    private CPF $CPFObject;

    public function setUp(): void
    {
        $this->CPFObject = new CPF();
    }

    /**
     * Test method for validate method.
     */
    public function testValidCPF(): void
    {
        $CPF = "52998224725";
        $result = $this->CPFObject->validate($CPF);

        $this->assertTrue($result, "Failed to validate CPF with valid input.");
    }

    public function testInvalidCPF(): void
    {
        $CPF = "12345678901";
        $result = $this->CPFObject->validate($CPF);

        $this->assertFalse($result, "Failed to invalidate CPF with invalid input.");
    }

    public function testMalformedCPF(): void
    {
        $CPF = "A123B567C901";
        $result = $this->CPFObject->validate($CPF);

        $this->assertFalse($result, "Failed to invalidate CPF with malformed input.");
    }

    public function testRepeatedDigitsCPF(): void
    {
        $CPF = "11111111111";
        $result = $this->CPFObject->validate($CPF);

        $this->assertFalse($result, "Failed to invalidate CPF with repeated digits input.");
    }
}