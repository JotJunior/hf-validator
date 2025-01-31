<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    private Email $email;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);

        $this->email = new Email($queryBuilder);
    }

    public function testValidateWithEmptyValue()
    {
        $this->assertTrue($this->email->validate(''));
    }

    public function testValidateWithInvalidString()
    {
        $this->assertFalse($this->email->validate(123));
    }

    public function testValidateWithResolvedDomain()
    {
        $this->email->setCheckDomain(true);
        $this->assertTrue($this->email->validate('jot@jot.com.br'));
    }

    public function testValidateWithInvalidEmail()
    {
        $this->assertFalse($this->email->validate('invalidEmail'));
    }

    public function testValidateWithInvalidDomain()
    {
        $this->email->setCheckDomain(true);
        $this->assertFalse($this->email->validate('invalidEmail'));
    }

    public function testValidateWithValidEmail()
    {
        $this->assertTrue($this->email->validate('tester@gmail.com'));
    }

    public function testValidateWithValidEmailAndCheckDomainEnabled()
    {
        $this->email->setCheckDomain(true);
        $this->assertTrue($this->email->validate('tester@gmail.com'));
    }

    public function testValidateWithInValidEmailAndCheckDomainEnabled()
    {
        $this->email->setCheckDomain(true);
        $this->assertFalse($this->email->validate('tester@nonexistentmaildomain.co.xpto'));
    }
}