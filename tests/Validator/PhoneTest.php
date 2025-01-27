<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Phone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Phone::class)]
class PhoneTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    #[DataProvider('phoneValidationProvider')]
    public function testValidate(string $phone, string $countryCode, bool $isValid, ?string $expectedErrorMessage): void
    {

        $testPhone = new Phone(countryCode: $countryCode);
        $result = $testPhone->validate(value: $phone);

        if ($isValid) {
            $this->assertTrue($result);
            $this->assertEmpty($testPhone->getErrors());
            return;
        }

        $this->assertFalse($result);
        $this->assertEquals($expectedErrorMessage, $testPhone->getErrors()[0]);

    }


    static public function phoneValidationProvider(): array
    {
        return [
            ['+5511987654321', 'BR', true, null],
            ['+5511587654321', 'BR', false, 'Invalid phone number.'],
            ['+12340567890', 'US', true, null],
            ['+441234567890', 'GB', true, null],
            ['+491234567890', 'DE', true, null],
            ['+9324567890', 'FR', false, 'Invalid phone number.'],
            ['+39234567890', 'IT', false, 'Invalid phone number.'],
            ['+111111111101', 'ZZZ', false, 'No validator found for country code: ZZZ. Please provide a valid country code.']
        ];
    }
}