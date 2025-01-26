<?php

namespace Jot\HfValidatorTest\Validators;

use Jot\HfValidator\Phone;
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
    public function testValidate(string $phone, string $countryCode, bool $isValid, ?string $expectedException): void
    {

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }

        $phone = new Phone(phone: $phone, countryCode: $countryCode);
        $result = $phone->validate();

        if ($isValid) {
            $this->assertTrue($result);
            return;
        }

        $this->assertFalse($result);

    }


    static public function phoneValidationProvider(): array
    {
        return [
            ['+5511987654321', 'BR', true, null],
            ['+5511587654321', 'BR', false, null],
            ['+12340567890', 'US', true, null],
            ['+441234567890', 'GB', true, null],
            ['+491234567890', 'DE', true, null],
            ['+9324567890', 'FR', false, null],
            ['+39234567890', 'IT', false, null],
            ['+111111111101', 'ZZZ', false, \InvalidArgumentException::class]
        ];
    }
}