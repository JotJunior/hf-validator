<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Lt;
use Jot\HfValidator\Validator\Lte;
use PHPUnit\Framework\TestCase;

class LteTest extends TestCase
{
    public function testValidateWithNumericValue(): void
    {
        $mockObj = new Lte(20);

        $resultMinus = $mockObj->validate(10);
        $this->assertTrue($resultMinus);

        $resultEqual = $mockObj->validate(20);
        $this->assertTrue($resultEqual);

        $resultPlus = $mockObj->validate(21);
        $this->assertFalse($resultPlus);
    }

    public function testValidateWithDatetimeValue(): void
    {
        $demoDate = new \DateTime("2021-01-02");
        $mockObj = new Lte($demoDate);

        $demoDateEqual = new \DateTime("2021-01-02");
        $result = $mockObj->validate($demoDateEqual);
        $this->assertTrue($result);

        $demoDatePlus = new \DateTime("2021-01-05");
        $result = $mockObj->validate($demoDatePlus);
        $this->assertFalse($result);

        $demoDateMinus = new \DateTime("2021-01-01");
        $resultFalse = $mockObj->validate($demoDateMinus);
        $this->assertTrue($resultFalse);
    }

    public function testValidateWithMixedValueTypes(): void
    {
        $demoDate = new \DateTime("2021-01-01");
        $mockObj = new Lte($demoDate);
        $resultFalse = $mockObj->validate(10);
        $this->assertFalse($resultFalse);

        $mockObjNum = new Lte(10);
        $resultFalseNum = $mockObjNum->validate($demoDate);
        $this->assertFalse($resultFalseNum);
    }
}