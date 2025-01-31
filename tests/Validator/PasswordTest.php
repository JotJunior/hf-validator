<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{

    protected Password $password;

    protected function setUp(): void
    {
        $mockQueryBuilder = $this->createMock(\Jot\HfElastic\QueryBuilder::class);
        $this->password = new Password($mockQueryBuilder);
        $this->password
            ->setRequireLower(true)
            ->setRequireUpper(true)
            ->setRequireNumber(true)
            ->setRequireSpecial(true)
            ->setSpecial('@#$')
            ->setMinLength(5)
            ->setMaxLength(10);
    }

    public function testValidateWithEmptyPassword(): void
    {
        $this->assertTrue($this->password->validate(''));
        $this->assertEmpty($this->password->consumeErrors());
    }

    public function testValidateWithShortPassword(): void
    {
        $this->assertFalse($this->password->validate('1234'));
        $this->assertNotEmpty($this->password->consumeErrors());
    }

    public function testValidateWithLongPassword(): void
    {
        $this->assertFalse($this->password->validate('123451234512345'));
        $this->assertNotEmpty($this->password->consumeErrors());
    }

    public function testValidateWithValidPassword(): void
    {
        $this->assertTrue($this->password->validate('abAB12@#$'));
        $this->assertEmpty($this->password->consumeErrors());
    }

    public function testValidateWithMissingLowerPassword(): void
    {
        $this->assertFalse($this->password->validate('AB12@#$'));
        $this->assertNotEmpty($this->password->consumeErrors());
    }

    public function testValidateWithMissingUpperPassword(): void
    {
        $this->assertFalse($this->password->validate('ab12@#$'));
        $this->assertNotEmpty($this->password->consumeErrors());
    }

    public function testValidateWithMissingNumberPassword(): void
    {
        $this->assertFalse($this->password->validate('abAB@#$'));
        $this->assertNotEmpty($this->password->consumeErrors());
    }

    public function testValidateWithMissingSpecialCharPassword(): void
    {
        $this->assertFalse($this->password->validate('abAB123'));
        $this->assertNotEmpty($this->password->consumeErrors());
    }

//    public function testValidate()
//    {
//
//
//        $this->assertTrue($password->validate('abcde'));
//        $this->assertFalse($password->validate('abcd'));
//
//        $password->setRequireLower(true);
//        $this->assertTrue($password->validate('abcde'));
//        $this->assertFalse($password->validate('ABCDE'));
//
//        $password->setRequireUpper(true);
//        $this->assertTrue($password->validate('abcdeF'));
//        $this->assertFalse($password->validate('abcdef'));
//
//        $password->setRequireNumber(true);
//        $this->assertTrue($password->validate('abcdeF1'));
//        $this->assertFalse($password->validate('abcdeF'));
//
//        $password->setRequireSpecial(true);
//        $this->assertTrue($password->validate('abcdeF1!'));
//        $this->assertFalse($password->validate('abcdeF1'));
//    }
//
//    public function testValidateWithErrors()
//    {
//        $mockQueryBuilder = $this->createMock(\Jot\HfElastic\QueryBuilder::class);
//        $password = new Password($mockQueryBuilder);
//
//        $password->validate('abcde');
//        $this->assertNotEmpty($password->consumeErrors());
//
//        $password->validate('');
//        $this->assertNotEmpty($password->consumeErrors());
//    }
}