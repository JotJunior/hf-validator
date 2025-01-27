<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Enum;
use PHPUnit\Framework\TestCase;

final class EnumTest extends TestCase
{
    public function testValidate(): void
    {
        $arr = [null, false, 0, "0", "", []];
        $enum = new Enum($arr);

        foreach ($arr as $value) {
            $this->assertTrue($enum->validate($value));
        }

        $unexpectedValues = [1, true, 'true', 'FALSE', 'Yes', 'No', ['No']];
        foreach ($unexpectedValues as $value) {
            $this->assertFalse($enum->validate($value));
        }
    }
}