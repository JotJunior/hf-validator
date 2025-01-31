<?php
/**
 * Unit tests for the Url class
 *
 * {@see \Jot\HfValidator\Validator\Url}
 */

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    private Url $urlValidator;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->urlValidator = new Url($queryBuilder);
    }

    public function testValidateValidUrls(): void
    {
        $this->assertTrue($this->urlValidator->setCheckDomain(false)->setForceHttps(false)->validate('http://google.com'));
        $this->assertTrue($this->urlValidator->setCheckDomain(true)->setForceHttps(false)->validate('http://google.com'));
        $this->assertTrue($this->urlValidator->setCheckDomain(false)->setForceHttps(true)->validate('https://google.com'));
        $this->assertTrue($this->urlValidator->setCheckDomain(true)->setForceHttps(true)->validate('https://google.com'));
    }

    public function testValidateInvalidUrls(): void
    {
        $this->assertFalse($this->urlValidator->setCheckDomain(false)->setForceHttps(false)->validate('invalid url'));
        $this->assertFalse($this->urlValidator->setCheckDomain(false)->setForceHttps(false)->validate('http:google.com'));
        $this->assertFalse($this->urlValidator->setCheckDomain(false)->setForceHttps(true)->validate('http://google.com'));
        $this->assertFalse($this->urlValidator->setCheckDomain(true)->setForceHttps(false)->validate('http://nonexistentdomain123.com'));
    }

    public function testValidateEmptyValue(): void
    {
        $this->assertTrue($this->urlValidator->setCheckDomain(false)->setForceHttps(false)->validate(''));
    }
}