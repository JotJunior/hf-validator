<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Gt;
use PHPUnit\Framework\TestCase;

class GtTest extends TestCase
{
    public function testValidateWithNumericValue(): void
    {
        $mockObj = new Gt(10);
        $resultMinus = $mockObj->validate(9);
        $this->assertFalse($resultMinus);

        $resultEqual = $mockObj->validate(10);
        $this->assertFalse($resultEqual);

        $resultPlus = $mockObj->validate(21);
        $this->assertTrue($resultPlus);
    }

    public function testValidateWithDatetimeValue(): void
    {
        $demoDate = new \DateTime("2021-01-01");
        $mockObj = new Gt($demoDate);

        $demoDateEquals = new \DateTime("2021-01-01");
        $result = $mockObj->validate($demoDateEquals);
        $this->assertFalse($result);

        $demoDatePlus = new \DateTime("2021-01-02");
        $result = $mockObj->validate($demoDatePlus);
        $this->assertTrue($result);

        $demoDateMinus = new \DateTime("2020-01-01");
        $resultFalse = $mockObj->validate($demoDateMinus);
        $this->assertFalse($resultFalse);
    }

    public function testValidateWithMixedValueTypes(): void
    {
        $demoDate = new \DateTime("2021-01-01");
        $mockObj = new Gt($demoDate);
        $resultFalse = $mockObj->validate(10);
        $this->assertFalse($resultFalse);

        $mockObjNum = new Gt(10);
        $resultFalseNum = $mockObjNum->validate($demoDate);
        $this->assertFalse($resultFalseNum);
    }
}