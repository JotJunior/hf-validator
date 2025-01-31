<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Required;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RequiredTest extends TestCase
{
    private $required;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->required = new Required($queryBuilder);
    }

    #[DataProvider('validDataProvider')]
    public function testValidateWithValidData($value)
    {
        $this->assertTrue($this->required->validate($value));
    }

    #[DataProvider('validDataProvider')]
    public function testValidateWithValidDataOnCreate($value)
    {
        $this->required->setOnCreate(true)->setOnUpdate(false);
        $this->assertTrue($this->required->onCreate()->validate($value));
    }

    #[DataProvider('validDataProvider')]
    public function testValidateWithValidDataOnUpdate($value)
    {
        $this->required->setOnCreate(false)->setOnUpdate(true);
        $this->assertTrue($this->required->onUpdate()->validate($value));
    }

    #[DataProvider('invalidDataProvider')]
    public function testValidateWithInvalidData($value)
    {
        $this->assertFalse($this->required->validate($value));
    }

    #[DataProvider('invalidDataProvider')]
    public function testValidateWithInvalidDataOnCreate($value)
    {
        $this->required->setOnCreate(true)->setOnUpdate(false);
        $this->assertFalse($this->required->onCreate()->validate($value));
    }

    #[DataProvider('invalidDataProvider')]
    public function testValidateWithInvalidDataOnUpdate($value)
    {
        $this->required->setOnCreate(false)->setOnUpdate(true);
        $this->assertFalse($this->required->onUpdate()->validate($value));
    }

    public function testIsInvalidObject()
    {
        $object = new class {
            public function getId()
            {
                return null;
            }
        };

        $this->assertFalse($this->required->validate($object));
    }

    static public function validDataProvider(): array
    {
        return [
            ['A valid string'],
            [123456],
            [1.23456],
            [new \stdClass()],
        ];
    }

    static public function invalidDataProvider(): array
    {
        return [
            [''],
            [' '],
            [null],
        ];
    }
}