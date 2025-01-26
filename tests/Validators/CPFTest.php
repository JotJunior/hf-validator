<?php

namespace Jot\HfValidatorTest\Validators;

use Jot\HfValidator\CPF;
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
        $docNumber = new CPF('52998224725');
        $this->assertTrue($docNumber->validate());
    }

    public function testInvalidCPF(): void
    {
        $docNumber = new CPF('12345678901');
        $this->assertFalse($docNumber->validate());
    }

    public function testMalformedCPF(): void
    {
        $docNumber = new CPF('A123B567C901');
        $this->assertFalse($docNumber->validate());
    }

    public function testRepeatedDigitsCPF(): void
    {
        $docNumber = new CPF('11111111111');
        $this->assertFalse($docNumber->validate());
    }
}