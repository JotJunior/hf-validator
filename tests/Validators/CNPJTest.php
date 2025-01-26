<?php

namespace Jot\HfValidatorTest\Validators;

use Jot\HfValidator\Validator\CNPJ;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
class CNPJTest extends TestCase
{
    /**
     * CNPJ instance.
     *
     * @var CNPJ
     */
    protected $cnpj;

    public function setUp(): void
    {
        $this->cnpj = new CNPJ();
    }

    /**
     * Test validate function with valid CNPJ.
     */
    public function testValidateWithValidCNPJ()
    {
        $this->assertTrue($this->cnpj->validate('32.403.065/0001-74'));
    }

    /**
     * Test validate function with invalid CNPJ.
     */
    public function testValidateWithInvalidCNPJ()
    {
        $this->assertFalse($this->cnpj->validate('04.000.000/0000-00'));
    }

    /**
     * Test validate function with valid and sanitized CNPJ.
     */
    public function testValidateWithValidAndSanitizedCNPJ()
    {
        $this->assertTrue($this->cnpj->validate('32403065000174'));
    }

    /**
     * Test validate function with invalid and sanitized CNPJ.
     */
    public function testValidateWithInvalidAndSanitizedCNPJ()
    {
        $this->assertFalse($this->cnpj->validate('04000000000000'));
    }
}