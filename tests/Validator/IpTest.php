<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Ip;
use PHPUnit\Framework\TestCase;

class IpTest extends TestCase
{
    private Ip $ip;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->ip = new Ip($queryBuilder);
    }

    public function testValidateReturnsTrueWithValidIpv4(): void
    {
        $ipv4 = '127.0.0.1';
        $this->assertTrue($this->ip->validate($ipv4));
    }

    public function testValidateReturnsFalseWithDisabledIpv4(): void
    {
        $ipv4 = '127.0.0.1';
        $this->ip->setIpv4(false);
        $this->assertFalse($this->ip->validate($ipv4));
    }

    public function testValidateReturnsFalseWithDisabledIpv6(): void
    {
        $ipv6 = '::1';
        $this->ip->setIpv6(false);
        $this->assertFalse($this->ip->validate($ipv6));
    }

    public function testValidateReturnsTrueWithEmptyValue(): void
    {
        $this->assertTrue($this->ip->validate(''));
    }

    public function testValidateReturnsFalseWithInvalidIpv4(): void
    {
        $ipv4 = '256.0.0.1';
        $this->assertFalse($this->ip->validate($ipv4));
    }

    public function testValidateReturnsTrueWithValidIpv6()
    {
        $ipv6 = '::1';
        $this->assertTrue($this->ip->validate($ipv6));
    }

    public function testValidateReturnsFalseWithInvalidIpv6()
    {
        $ipv6 = '2001:0:!23';
        $this->assertFalse($this->ip->validate($ipv6));
    }
}