<?php

namespace Jot\HfValidatorTest\Validators;

use Jot\HfValidator\Validator\CPF;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
class CPFTest extends TestCase
{

    public function setUp(): void
    {
    }

    public function testValidCPF(): void
    {
        $this->assertTrue((new CPF())->validate(value: '52998224725'));
    }

    public function testInvalidCPF(): void
    {
        $this->assertFalse((new CPF())->validate(value: '12345678901'));
    }

    public function testMalformedCPF(): void
    {
        $this->assertFalse((new CPF())->validate(value: 'A123B567C901'));
    }

    public function testRepeatedDigitsCPF(): void
    {
        $this->assertFalse((new CPF())->validate(value: '11111111111'));
    }
}