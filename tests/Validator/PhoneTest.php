<?php

namespace Jot\HfValidatorTest\Validator;

use Hyperf\Stringable\Str;
use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    private Phone $phone;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->phone = new Phone($queryBuilder);
    }

    public function testValidateWithEmptyValueReturnsTrue()
    {
        $result = $this->phone->validate('');
        $this->assertTrue($result);
    }

    public function testValidateWithInvalidCountryCode()
    {
        $this->phone->setCountryCode('XX');
        $result = $this->phone->validate('1234567890');
        $expectedError = sprintf(Phone::ERROR_INVALID_COUNTRY_CODE, 'XX');
        $errors = $this->phone->consumeErrors();

        $this->assertFalse($result);
        $this->assertContains($expectedError, $errors);
    }

    public function testValidateWithInvalidPhoneNumber()
    {
        $this->phone->setCountryCode('BR');

        // Assuming `BR` country code expects a 10 digit phone number.
        $result = $this->phone->validate('123456789');
        $expectedError = Phone::ERROR_INVALID_PHONE_NUMBER;
        $errors = $this->phone->consumeErrors();

        $this->assertFalse($result);
        $this->assertContains($expectedError, $errors);
    }

    public function testValidateWithValidBrazilianMobileNumber()
    {
        $this->phone->setCountryCode('BR');

        // Assuming `BR` country code expects a 10 digit phone number.
        $result = $this->phone->validate('+5511995544332');

        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithInvalidBrazilianMobileNumber()
    {
        $this->phone->setCountryCode('BR');

        $result = $this->phone->validate('+5511595544332');

        $this->assertFalse($result);
        $this->assertNotEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithInvalidBrazilianAreaCode()
    {
        $this->phone->setCountryCode('BR');

        $result = $this->phone->validate('+5520995544332');

        $this->assertFalse($result);
        $this->assertNotEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidBrazilianResidentialNumber()
    {
        $this->phone->setCountryCode('BR');

        $result = $this->phone->validate('+551155544332');

        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidUSNumber()
    {
        $this->phone->setCountryCode('US');
        $result = $this->phone->validate('+12015554332');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithInvalidUSNumber()
    {
        $this->phone->setCountryCode('US');
        $result = $this->phone->validate('+1201544332');
        $this->assertFalse($result);
        $this->assertNotEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithInvalidUSNumberAreaCode()
    {
        $this->phone->setCountryCode('US');
        $result = $this->phone->validate('+11001544332');
        $this->assertFalse($result);
        $this->assertNotEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidARNumber()
    {
        $this->phone->setCountryCode('AR');
        $result = $this->phone->validate('+545155115268');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidATNumber()
    {
        $this->phone->setCountryCode('AT');
        $result = $this->phone->validate('+436197102230');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidAUNumber()
    {
        $this->phone->setCountryCode('AU');
        $result = $this->phone->validate('+614620235980');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidBENumber()
    {
        $this->phone->setCountryCode('BE');
        $result = $this->phone->validate('+322403346373');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidCANumber()
    {
        $this->phone->setCountryCode('CA');
        $result = $this->phone->validate('+18712609279');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidCLNumber()
    {
        $this->phone->setCountryCode('CL');
        $result = $this->phone->validate('+564113565093');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidCNNumber()
    {
        $this->phone->setCountryCode('CN');
        $result = $this->phone->validate('+415398093993');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidCONumber()
    {
        $this->phone->setCountryCode('CO');
        $result = $this->phone->validate('+579859535321');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidCZNumber()
    {
        $this->phone->setCountryCode('CZ');
        $result = $this->phone->validate('+4209886601360');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidDENumber()
    {
        $this->phone->setCountryCode('DE');
        $result = $this->phone->validate('+495878973249');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidDKNumber()
    {
        $this->phone->setCountryCode('DK');
        $result = $this->phone->validate('+459071643038');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidESNumber()
    {
        $this->phone->setCountryCode('ES');
        $result = $this->phone->validate('+348724958201');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidFINumber()
    {
        $this->phone->setCountryCode('FI');
        $result = $this->phone->validate('+3581340327734');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidFRNumber()
    {
        $this->phone->setCountryCode('FR');
        $result = $this->phone->validate('+331260913868');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidGBNumber()
    {
        $this->phone->setCountryCode('GB');
        $result = $this->phone->validate('+449404417215');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidHUNumber()
    {
        $this->phone->setCountryCode('HU');
        $result = $this->phone->validate('+367033518710');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidIENumber()
    {
        $this->phone->setCountryCode('IE');
        $result = $this->phone->validate('+3539437305237');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidINNumber()
    {
        $this->phone->setCountryCode('IN');
        $result = $this->phone->validate('+917015475949');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidITNumber()
    {
        $this->phone->setCountryCode('IT');
        $result = $this->phone->validate('+395323227136');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidLUNumber()
    {
        $this->phone->setCountryCode('LU');
        $result = $this->phone->validate('+3528905643340');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidMXNumber()
    {
        $this->phone->setCountryCode('MX');
        $result = $this->phone->validate('+525149048032');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidNLNumber()
    {
        $this->phone->setCountryCode('NL');
        $result = $this->phone->validate('+319447380087');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidNONumber()
    {
        $this->phone->setCountryCode('NO');
        $result = $this->phone->validate('+478200181928');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidNZNumber()
    {
        $this->phone->setCountryCode('NZ');
        $result = $this->phone->validate('+646427665626');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidPENumber()
    {
        $this->phone->setCountryCode('PE');
        $result = $this->phone->validate('+517293537844');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidPLNumber()
    {
        $this->phone->setCountryCode('PL');
        $result = $this->phone->validate('+484185892596');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidPTNumber()
    {
        $this->phone->setCountryCode('PT');
        $result = $this->phone->validate('+3517182010596');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidRUNumber()
    {
        $this->phone->setCountryCode('RU');
        $result = $this->phone->validate('+79571303269');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidSENumber()
    {
        $this->phone->setCountryCode('SE');
        $result = $this->phone->validate('+467187087002');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidSKNumber()
    {
        $this->phone->setCountryCode('SK');
        $result = $this->phone->validate('+4212975797970');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidTRNumber()
    {
        $this->phone->setCountryCode('TR');
        $result = $this->phone->validate('+907125154687');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidUANumber()
    {
        $this->phone->setCountryCode('UA');
        $result = $this->phone->validate('+3802644008369');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }

    public function testValidateWithValidVENumber()
    {
        $this->phone->setCountryCode('VE');
        $result = $this->phone->validate('+584689291776');
        $this->assertTrue($result);
        $this->assertEmpty($this->phone->consumeErrors());
    }


}