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
use Jot\HfValidator\Validator\CountryPhonePatterns;
use Jot\HfValidator\Validator\Phone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
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
     * Data provider for valid phone numbers.
     *
     * @return array<array{string, string}>
     */
    public static function validPhoneNumbersProvider(): array
    {
        return [
            ['AR', '+541131234567'],
            ['AR', '+5493513234567'],
            ['AU', '+61462023598'],
            ['BR', '+5511987654321'],
            ['BR', '+551147654321'],
            ['CA', '+14161234567'],
            ['CL', '+56229473809'],
            ['CN', '+8613123456789'],
            ['CO', '+573123456789'],
            ['CR', '+50688123456'],
            ['CZ', '+420123456789'],
            ['DE', '+495878973249'],
            ['DK', '+4512345678'],
            ['ES', '+34872495820'],
            ['FI', '+358451234567'],
            ['FR', '+33126091386'],
            ['GB', '+449404417215'],
            ['GR', '+306912345678'],
            ['HK', '+85212345678'],
            ['HU', '+36201234567'],
            ['ID', '+6281234567890'],
            ['IE', '+353871234567'],
            ['IL', '+972521234567'],
            ['IN', '+917015475949'],
            ['IT', '+395323227136'],
            ['LU', '+35289056433'],
            ['MX', '+525149048032'],
            ['NL', '+31612345678'],
            ['NO', '+4712345678'],
            ['NZ', '+64642766562'],
            ['PE', '+51729353784'],
            ['PH', '+639323456789'],
            ['PL', '+48123456789'],
            ['PT', '+351912345678'],
            ['RO', '+407213456784'],
            ['RO', '+40213456784'],
            ['RU', '+79571303269'],
            ['SE', '+46701234567'],
            ['SK', '+421297579797'],
            ['TR', '+907125154687'],
            ['UA', '+380501234567'],
            ['US', '+12025550179'],
            ['VE', '+584123456789'],
            ['ZA', '+27711234567'],
        ];
    }

    /**
     * Data provider for invalid phone numbers.
     *
     * @return array<array{string, string}>
     */
    public static function invalidPhoneNumbersProvider(): array
    {
        return [
            ['US', '+1202555'], // Too short
            ['US', '+120255501799'], // Too long
            ['US', '+12025550ABC'], // Contains letters
            ['US', '2025550179'], // Missing country code
            ['BR', '+5511123'], // Too short
            ['BR', '+551198765432123'], // Too long
            ['BR', '+551198765ABC'], // Contains letters
            ['BR', '11987654321'], // Missing country code
            ['GB', '+4494044ABC'], // Contains letters
            ['GB', '+44'], // Too short
            ['DE', '+49123'], // Too short
            ['FR', '+33ABC'], // Contains letters
        ];
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

    #[Test]
    #[Group('unit')]
    public function testValidateWithLiteralPhoneClass(): void
    {
        // Arrange
        $validator = new Phone\AR();

        // Act
        $result = $validator->validate('+541131234567');
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    #[Test]
    #[Group('unit')]
    public function testCountryPhonePatternsValues(): void
    {
        // Assert and act
        $this->assertEquals('BR', CountryPhonePatterns::forCountry('BR')->name);
    }

    /**
     * What is being tested:
     * - Phone validator with valid phone numbers for different countries
     * Conditions/Scenarios:
     * - Country code is set for each test case
     * - A valid phone number for that country is provided
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('validPhoneNumbersProvider')]
    public function testValidateWithValidPhoneNumbers(string $countryCode, string $validNumber): void
    {
        // Arrange
        $this->phone->setCountryCode($countryCode);

        // Act
        $result = $this->phone->validate($validNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }

    /**
     * What is being tested:
     * - Phone validator with invalid phone numbers
     * Conditions/Scenarios:
     * - Country code is set for each test case
     * - An invalid phone number for that country is provided
     * Expected results:
     * - Validation fails (returns false)
     * - Appropriate errors are generated
     */
    #[Test]
    #[Group('unit')]
    #[DataProvider('invalidPhoneNumbersProvider')]
    public function testValidateWithInvalidPhoneNumbers(string $countryCode, string $invalidNumber): void
    {
        // Arrange
        $this->phone->setCountryCode($countryCode);

        // Act
        $result = $this->phone->validate($invalidNumber);
        $errors = $this->phone->consumeErrors();

        // Assert
        $this->assertFalse($result);
        $this->assertNotEmpty($errors);
    }
}
