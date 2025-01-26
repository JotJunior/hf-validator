<?php

namespace Jot\HfValidator\Validator\Tests;

use Jot\HfValidator\Validator\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    /** @var Phone */
    private $mobilePhoneValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mobilePhoneValidator = new Phone();
    }

    /**
     * @dataProvider phoneNumbersDataProvider
     */
    public function testValidate(string $phone, string $countryCode, bool $isValid): void
    {

        if (!$isValid) {
            $this->expectException(\InvalidArgumentException::class);
        }

        $result = $this->mobilePhoneValidator->validate($phone, $countryCode);

        if ($isValid) {
            $this->assertTrue($result);
        }
    }

    public function phoneNumbersDataProvider(): array
    {
        return [
            ['+5511987654321', 'BR', true],
//            ['+5511587654321', 'BR', false],
//            ['+1234567890', 'US', true],
//            ['+441234567890', 'GB', false],
//            ['+491234567890', 'DE', true],
//            ['+9324567890', 'FR', false],
//            ['+39234567890', 'IT', true],
//            ['+111111111101', 'ZZZ', false]
        ];
    }
}