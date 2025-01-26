<?php

namespace Jot\HfValidatorTest\Validators;

use Jot\HfValidator\CNPJ;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
class CNPJTest extends TestCase
{

    public function setUp(): void
    {
    }

    public function testValidateWithValidCNPJ()
    {
        $docNumber = new CNPJ(number: '32403065000174');
        $this->assertTrue($docNumber->validate());
    }

    public function testValidateWithInvalidCNPJ()
    {
        $docNumber = new CNPJ(number: '04.000.000/0000-00');
        $this->assertFalse($docNumber->validate());
    }

    public function testValidateWithValidAndSanitizedCNPJ()
    {
        $docNumber = new CNPJ(number: '32403065000174');
        $this->assertTrue($docNumber->validate());
    }

    public function testValidateWithInvalidAndSanitizedCNPJ()
    {
        $docNumber = new CNPJ(number: '04000000000000');
        $this->assertFalse($docNumber->validate());
    }
}