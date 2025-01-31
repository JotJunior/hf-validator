<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Regex;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    private Regex $validator;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->validator = new Regex($queryBuilder);
    }

    public function testValidateWithValidValue(): void
    {
        $this->validator->setPattern('/^[a-z]+$/');
        $this->assertTrue($this->validator->validate('teststring'));
    }

    public function testValidateWithInvalidValue(): void
    {
        $this->validator->setPattern('/^[a-z]+$/');
        $this->assertFalse($this->validator->validate('Test1234'));
    }

    public function testValidateWithEmptyValue(): void
    {
        $this->assertTrue($this->validator->validate(''));
    }

    public function testValidateWithNull(): void
    {
        $this->assertTrue($this->validator->validate(null));
    }

    public function testValidateInvalidRegexPattern(): void
    {
        $this->validator->setPattern('/^$[a-z]+$/');
        $this->assertTrue($this->validator->validate(null));
    }
}