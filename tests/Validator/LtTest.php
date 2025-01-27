<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfValidator\Validator\Lt;
use PHPUnit\Framework\TestCase;

class LtTest extends TestCase
{
    public function testValidateWithNumericValue(): void
    {
        $mockObj = new Lt(20);

        $resultMinus = $mockObj->validate(10);
        $this->assertTrue($resultMinus);

        $resultEqual = $mockObj->validate(20);
        $this->assertFalse($resultEqual);

        $resultPlus = $mockObj->validate(21);
        $this->assertFalse($resultPlus);
    }

    public function testValidateWithDatetimeValue(): void
    {
        $demoDate = new \DateTime("2021-01-02");
        $mockObj = new Lt($demoDate);

        $demoDateEqual = new \DateTime("2021-01-02");
        $result = $mockObj->validate($demoDateEqual);
        $this->assertFalse($result);

        $demoDatePlus = new \DateTime("2021-01-01");
        $result = $mockObj->validate($demoDatePlus);
        $this->assertTrue($result);

        $demoDateMinus = new \DateTime("2022-01-01");
        $resultFalse = $mockObj->validate($demoDateMinus);
        $this->assertFalse($resultFalse);
    }

    public function testValidateWithMixedValueTypes(): void
    {
        $demoDate = new \DateTime("2021-01-01");
        $mockObj = new Lt($demoDate);
        $resultFalse = $mockObj->validate(10);
        $this->assertFalse($resultFalse);

        $mockObjNum = new Lt(10);
        $resultFalseNum = $mockObjNum->validate($demoDate);
        $this->assertFalse($resultFalseNum);
    }
}