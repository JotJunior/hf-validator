<?php

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\CPF;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    private CPF $cpfValidator;

    protected function setUp(): void
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->cpfValidator = new CPF($queryBuilder);
    }

    public function testValidCPF(): void
    {
        $this->assertTrue($this->cpfValidator->validate('57804827059'));
        $this->assertTrue($this->cpfValidator->validate('578.048.270-59'));
        $this->assertEmpty($this->cpfValidator->consumeErrors());
    }

    public function testEmptyCPF(): void
    {
        $this->assertTrue($this->cpfValidator->validate(''));
        $this->assertEmpty($this->cpfValidator->consumeErrors());
    }

    public function testInvalidCPF(): void
    {
        $this->assertFalse($this->cpfValidator->validate('123.456.789-00'));
        $this->assertFalse($this->cpfValidator->validate('12345678900'));
        $this->assertContains(CPF::ERROR_INVALID_CPF, $this->cpfValidator->consumeErrors());
    }

    public function testNonStringCPF(): void
    {
        $this->assertFalse($this->cpfValidator->validate(12345678901));
        $this->assertContains(CPF::ERROR_NOT_A_STRING, $this->cpfValidator->consumeErrors());
    }

    public function testRepeatedDigitsCPF(): void
    {
        $this->assertFalse($this->cpfValidator->validate('11111111111'));
        $this->assertContains(CPF::ERROR_MALFORMED_CPF, $this->cpfValidator->consumeErrors());
    }

    public function testValidMaskCPF(): void
    {
        $this->cpfValidator->setValidateMask(true);

        $this->assertTrue($this->cpfValidator->validate('578.048.270-59'));
        $this->assertEmpty($this->cpfValidator->consumeErrors());
    }

    public function testInvalidMaskCPF(): void
    {
        $this->cpfValidator->setValidateMask(true);

        $this->assertFalse($this->cpfValidator->validate('578048270-59'));
        $this->assertContains(CPF::ERROR_MASK_MISMATCH, $this->cpfValidator->consumeErrors());
    }
}