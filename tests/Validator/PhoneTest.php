<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Phone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Phone::class)]
class PhoneTest extends TestCase
{
    private Phone $phone;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->phone = new Phone($queryBuilder);
    }

    /**
     * What is being tested:
     * - Phone validator with empty value
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithEmptyValueReturnsTrue(): void
    {
        // Arrange
        $emptyValue = '';

        // Act
        $result = $this->phone->validate($emptyValue);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Phone validator with invalid country code
     * Conditions/Scenarios:
     * - Country code 'XX' is set (which is invalid)
     * - A phone number is provided
     * Expected results:
     * - Validation fails (returns false)
     * - Error message contains the invalid country code
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidCountryCode(): void
    {
        // Arrange
        $invalidCountryCode = 'XX';
        $phoneNumber = '1234567890';
        $this->phone->setCountryCode($invalidCountryCode);
        $expectedError = sprintf(Phone::ERROR_INVALID_COUNTRY_CODE, $invalidCountryCode);

        // Act
        $result = $this->phone->validate($phoneNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertContains($expectedError, $errors);
    }

    /**
     * What is being tested:
     * - Phone validator with invalid phone number format
     * Conditions/Scenarios:
     * - Country code 'BR' is set (valid)
     * - An invalid phone number format is provided (too short)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message indicates invalid phone number
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidPhoneNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('BR');
        $invalidPhoneNumber = '123456789'; // Too short for BR format
        $expectedError = Phone::ERROR_INVALID_PHONE_NUMBER;

        // Act
        $result = $this->phone->validate($invalidPhoneNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertContains($expectedError, $errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Brazilian mobile number
     * Conditions/Scenarios:
     * - Country code 'BR' is set
     * - A valid Brazilian mobile number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidBrazilianMobileNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('BR');
        $validBrazilianMobile = '+5511995544332';

        // Act
        $result = $this->phone->validate($validBrazilianMobile);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with invalid Brazilian mobile number
     * Conditions/Scenarios:
     * - Country code 'BR' is set
     * - An invalid Brazilian mobile number is provided (incorrect digit after area code)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidBrazilianMobileNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('BR');
        $invalidBrazilianMobile = '+5511595544332'; // Invalid digit after area code

        // Act
        $result = $this->phone->validate($invalidBrazilianMobile);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with invalid Brazilian area code
     * Conditions/Scenarios:
     * - Country code 'BR' is set
     * - A phone number with invalid area code is provided
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidBrazilianAreaCode(): void
    {
        // Arrange
        $this->phone->setCountryCode('BR');
        $invalidAreaCode = '+5520995544332'; // Area code 20 is invalid for BR

        // Act
        $result = $this->phone->validate($invalidAreaCode);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Brazilian residential number
     * Conditions/Scenarios:
     * - Country code 'BR' is set
     * - A valid Brazilian residential number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidBrazilianResidentialNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('BR');
        $validResidential = '+551155544332';

        // Act
        $result = $this->phone->validate($validResidential);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid US phone number
     * Conditions/Scenarios:
     * - Country code 'US' is set
     * - A valid US phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidUSNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('US');
        $validUSNumber = '+12015554332';

        // Act
        $result = $this->phone->validate($validUSNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with invalid US phone number
     * Conditions/Scenarios:
     * - Country code 'US' is set
     * - An invalid US phone number is provided (too short)
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidUSNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('US');
        $invalidUSNumber = '+1201544332'; // Too short

        // Act
        $result = $this->phone->validate($invalidUSNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with invalid US area code
     * Conditions/Scenarios:
     * - Country code 'US' is set
     * - A phone number with invalid area code is provided
     * Expected results:
     * - Validation fails (returns false)
     * - Error message is generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithInvalidUSNumberAreaCode(): void
    {
        // Arrange
        $this->phone->setCountryCode('US');
        $invalidAreaCode = '+11001544332'; // Area code 100 is invalid for US

        // Act
        $result = $this->phone->validate($invalidAreaCode);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Argentina phone number
     * Conditions/Scenarios:
     * - Country code 'AR' is set
     * - A valid Argentina phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidARNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('AR');
        $validARNumber = '+545155115268';

        // Act
        $result = $this->phone->validate($validARNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Austria phone number
     * Conditions/Scenarios:
     * - Country code 'AT' is set
     * - A valid Austria phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidATNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('AT');
        $validATNumber = '+436197102230';

        // Act
        $result = $this->phone->validate($validATNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Australia phone number
     * Conditions/Scenarios:
     * - Country code 'AU' is set
     * - A valid Australia phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidAUNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('AU');
        $validAUNumber = '+614620235980';

        // Act
        $result = $this->phone->validate($validAUNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Belgium phone number
     * Conditions/Scenarios:
     * - Country code 'BE' is set
     * - A valid Belgium phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidBENumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('BE');
        $validBENumber = '+322403346373';

        // Act
        $result = $this->phone->validate($validBENumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Canada phone number
     * Conditions/Scenarios:
     * - Country code 'CA' is set
     * - A valid Canada phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidCANumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('CA');
        $validCANumber = '+18712609279';

        // Act
        $result = $this->phone->validate($validCANumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Chile phone number
     * Conditions/Scenarios:
     * - Country code 'CL' is set
     * - A valid Chile phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidCLNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('CL');
        $validCLNumber = '+564113565093';

        // Act
        $result = $this->phone->validate($validCLNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid China phone number
     * Conditions/Scenarios:
     * - Country code 'CN' is set
     * - A valid China phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidCNNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('CN');
        $validCNNumber = '+415398093993';

        // Act
        $result = $this->phone->validate($validCNNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Colombia phone number
     * Conditions/Scenarios:
     * - Country code 'CO' is set
     * - A valid Colombia phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidCONumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('CO');
        $validCONumber = '+579859535321';

        // Act
        $result = $this->phone->validate($validCONumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Czech Republic phone number
     * Conditions/Scenarios:
     * - Country code 'CZ' is set
     * - A valid Czech Republic phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidCZNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('CZ');
        $validCZNumber = '+4209886601360';

        // Act
        $result = $this->phone->validate($validCZNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Germany phone number
     * Conditions/Scenarios:
     * - Country code 'DE' is set
     * - A valid Germany phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidDENumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('DE');
        $validDENumber = '+495878973249';

        // Act
        $result = $this->phone->validate($validDENumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Denmark phone number
     * Conditions/Scenarios:
     * - Country code 'DK' is set
     * - A valid Denmark phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidDKNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('DK');
        $validDKNumber = '+459071643038';

        // Act
        $result = $this->phone->validate($validDKNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Spain phone number
     * Conditions/Scenarios:
     * - Country code 'ES' is set
     * - A valid Spain phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidESNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('ES');
        $validESNumber = '+348724958201';

        // Act
        $result = $this->phone->validate($validESNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Finland phone number
     * Conditions/Scenarios:
     * - Country code 'FI' is set
     * - A valid Finland phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidFINumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('FI');
        $validFINumber = '+3581340327734';

        // Act
        $result = $this->phone->validate($validFINumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid France phone number
     * Conditions/Scenarios:
     * - Country code 'FR' is set
     * - A valid France phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidFRNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('FR');
        $validFRNumber = '+331260913868';

        // Act
        $result = $this->phone->validate($validFRNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid United Kingdom phone number
     * Conditions/Scenarios:
     * - Country code 'GB' is set
     * - A valid United Kingdom phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidGBNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('GB');
        $validGBNumber = '+449404417215';

        // Act
        $result = $this->phone->validate($validGBNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Hungary phone number
     * Conditions/Scenarios:
     * - Country code 'HU' is set
     * - A valid Hungary phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidHUNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('HU');
        $validHUNumber = '+367033518710';

        // Act
        $result = $this->phone->validate($validHUNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Ireland phone number
     * Conditions/Scenarios:
     * - Country code 'IE' is set
     * - A valid Ireland phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidIENumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('IE');
        $validIENumber = '+3539437305237';

        // Act
        $result = $this->phone->validate($validIENumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid India phone number
     * Conditions/Scenarios:
     * - Country code 'IN' is set
     * - A valid India phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidINNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('IN');
        $validINNumber = '+917015475949';

        // Act
        $result = $this->phone->validate($validINNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Italy phone number
     * Conditions/Scenarios:
     * - Country code 'IT' is set
     * - A valid Italy phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidITNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('IT');
        $validITNumber = '+395323227136';

        // Act
        $result = $this->phone->validate($validITNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Luxembourg phone number
     * Conditions/Scenarios:
     * - Country code 'LU' is set
     * - A valid Luxembourg phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidLUNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('LU');
        $validLUNumber = '+3528905643340';

        // Act
        $result = $this->phone->validate($validLUNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Mexico phone number
     * Conditions/Scenarios:
     * - Country code 'MX' is set
     * - A valid Mexico phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidMXNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('MX');
        $validMXNumber = '+525149048032';

        // Act
        $result = $this->phone->validate($validMXNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Netherlands phone number
     * Conditions/Scenarios:
     * - Country code 'NL' is set
     * - A valid Netherlands phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidNLNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('NL');
        $validNLNumber = '+319447380087';

        // Act
        $result = $this->phone->validate($validNLNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Norway phone number
     * Conditions/Scenarios:
     * - Country code 'NO' is set
     * - A valid Norway phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidNONumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('NO');
        $validNONumber = '+478200181928';

        // Act
        $result = $this->phone->validate($validNONumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid New Zealand phone number
     * Conditions/Scenarios:
     * - Country code 'NZ' is set
     * - A valid New Zealand phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidNZNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('NZ');
        $validNZNumber = '+646427665626';

        // Act
        $result = $this->phone->validate($validNZNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Peru phone number
     * Conditions/Scenarios:
     * - Country code 'PE' is set
     * - A valid Peru phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidPENumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('PE');
        $validPENumber = '+517293537844';

        // Act
        $result = $this->phone->validate($validPENumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Poland phone number
     * Conditions/Scenarios:
     * - Country code 'PL' is set
     * - A valid Poland phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidPLNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('PL');
        $validPLNumber = '+484185892596';

        // Act
        $result = $this->phone->validate($validPLNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Portugal phone number
     * Conditions/Scenarios:
     * - Country code 'PT' is set
     * - A valid Portugal phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidPTNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('PT');
        $validPTNumber = '+3517182010596';

        // Act
        $result = $this->phone->validate($validPTNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Russia phone number
     * Conditions/Scenarios:
     * - Country code 'RU' is set
     * - A valid Russia phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidRUNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('RU');
        $validRUNumber = '+79571303269';

        // Act
        $result = $this->phone->validate($validRUNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Sweden phone number
     * Conditions/Scenarios:
     * - Country code 'SE' is set
     * - A valid Sweden phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidSENumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('SE');
        $validSENumber = '+467187087002';

        // Act
        $result = $this->phone->validate($validSENumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Slovakia phone number
     * Conditions/Scenarios:
     * - Country code 'SK' is set
     * - A valid Slovakia phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidSKNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('SK');
        $validSKNumber = '+4212975797970';

        // Act
        $result = $this->phone->validate($validSKNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Turkey phone number
     * Conditions/Scenarios:
     * - Country code 'TR' is set
     * - A valid Turkey phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidTRNumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('TR');
        $validTRNumber = '+907125154687';

        // Act
        $result = $this->phone->validate($validTRNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Ukraine phone number
     * Conditions/Scenarios:
     * - Country code 'UA' is set
     * - A valid Ukraine phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidUANumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('UA');
        $validUANumber = '+3802644008369';

        // Act
        $result = $this->phone->validate($validUANumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with valid Venezuela phone number
     * Conditions/Scenarios:
     * - Country code 'VE' is set
     * - A valid Venezuela phone number is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithValidVENumber(): void
    {
        // Arrange
        $this->phone->setCountryCode('VE');
        $validVENumber = '+584689291776';

        // Act
        $result = $this->phone->validate($validVENumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
