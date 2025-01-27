<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\CNPJ;
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
        $this->assertTrue((new CNPJ())->validate('32403065000174'));
    }

    public function testValidateWithInvalidCNPJ()
    {
        $this->assertFalse((new CNPJ())->validate('04.000.000/0000-00'));
    }

    public function testValidateWithValidAndSanitizedCNPJ()
    {
        $this->assertTrue((new CNPJ())->validate('32403065000174'));
    }

    public function testValidateWithInvalidAndSanitizedCNPJ()
    {
        $this->assertFalse((new CNPJ())->validate('04000000000000'));
    }
}