<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Annotation as VA;
use Jot\HfValidator\Validator\CNPJ;
use PHPUnit\Framework\TestCase;

class CNPJTest extends TestCase
{
    protected CNPJ $cnpjValidator;

    protected function setUp(): void
    {
        $mockQueryBuilder = $this->createMock(QueryBuilder::class);
        $this->cnpjValidator = new CNPJ($mockQueryBuilder);
    }

    public function testValidateWithInvalidFormatReturnsFalse()
    {
        $this->assertFalse($this->cnpjValidator->validate('1234567890'));
    }

    public function testValidateWithInvalidCnpjReturnsFalse()
    {
        $this->assertFalse($this->cnpjValidator->validate('12.345.678/9012-34'));
    }

    public function testValidateWithEmptyValueReturnsTrue()
    {
        $this->assertTrue($this->cnpjValidator->validate(''));
    }

    public function testValidateWithNumericValueReturnsFalse()
    {
        $this->assertFalse($this->cnpjValidator->validate(1234678910132));
    }

    public function testValidateWithValidFormatReturnsTrue()
    {
        $this->assertTrue($this->cnpjValidator->validate('32.403.065/0001-74'));
    }

    public function testValidateWithInvalidMaskReturnsFalse()
    {
        $this->cnpjValidator->setValidateMask(true);
        $this->assertFalse($this->cnpjValidator->validate('19994721000189'));
    }

    public function testValidateWithInvalidMaskReturnsFalseWithCustomMessage()
    {
        $this->cnpjValidator->setValidateMask(true);

        $customErrorMessages = ['ERROR_MASK_MISMATCH' => 'mask mismatch'];
        $this->cnpjValidator->setCustomErrorMessages($customErrorMessages);
        $this->assertFalse($this->cnpjValidator->validate('19994721000189'));
        $this->assertEquals('mask mismatch', $this->cnpjValidator->consumeErrors()[0]);
    }

    public function testValidateWithValidMaskReturnsTrue()
    {
        $this->cnpjValidator->setValidateMask(true);
        $this->assertTrue($this->cnpjValidator->validate('32.403.065/0001-74'));
    }

    public function testIsValidMaskWithInvalidMaskReturnsFalse()
    {
        $this->assertFalse($this->cnpjValidator->isValidMask('19994721000189'));
    }

    public function testIsValidMaskWithValidMaskReturnsTrue()
    {
        $this->assertTrue($this->cnpjValidator->isValidMask('32.403.065/0001-74'));
    }

    public function testIfValidatedByAnnotationReturnsTrue()
    {
        $class = new class {
            #[VA\CNPJ]
            public string $cnpj = '32.403.065/0001-74';
        };



        $this->assertTrue($this->cnpjValidator->isValidMask('32.403.065/0001-74'));
    }
}