<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Gte;
use PHPUnit\Framework\TestCase;

class GteTest extends TestCase
{
    public function testValidateWithNumericValue(): void
    {
        $mockObj = new Gte(10);
        $result = $mockObj->validate(20);
        $this->assertTrue($result);

        $resultFalse = $mockObj->validate(9);
        $this->assertFalse($resultFalse);
    }

    public function testValidateWithDatetimeValue(): void
    {
        $demoDate = new \DateTime("2021-01-01");
        $mockObj = new Gte($demoDate);

        $demoTestEqual = new \DateTime("2021-01-01");
        $resultFalse = $mockObj->validate($demoTestEqual);
        $this->assertTrue($resultFalse);

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
        $mockObj = new Gte($demoDate);
        $resultFalse = $mockObj->validate(10);
        $this->assertFalse($resultFalse);

        $mockObjNum = new Gte(10);
        $resultFalseNum = $mockObjNum->validate($demoDate);
        $this->assertFalse($resultFalseNum);
    }
}