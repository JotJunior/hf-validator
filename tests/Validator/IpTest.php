<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidatorTest\Validator;

use Jot\HfElastic\QueryBuilder;
use Jot\HfValidator\Validator\Ip;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Ip::class)]
class IpTest extends TestCase
{
    private Ip $ip;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->ip = new Ip($queryBuilder);
    }

    /**
     * What is being tested:
     * - Ip validator with valid IPv4 address
     * Conditions/Scenarios:
     * - IPv4 address '127.0.0.1' is provided
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateReturnsTrueWithValidIpv4(): void
    {
        // Arrange
        $ipv4 = '127.0.0.1';

        // Act
        $result = $this->ip->validate($ipv4);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Ip validator with IPv4 validation disabled
     * Conditions/Scenarios:
     * - IPv4 address '127.0.0.1' is provided
     * - IPv4 validation is disabled
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateReturnsFalseWithDisabledIpv4(): void
    {
        // Arrange
        $ipv4 = '127.0.0.1';
        $this->ip->setIpv4(false);

        // Act
        $result = $this->ip->validate($ipv4);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - Ip validator with IPv6 validation disabled
     * Conditions/Scenarios:
     * - IPv6 address '::1' is provided
     * - IPv6 validation is disabled
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateReturnsFalseWithDisabledIpv6(): void
    {
        // Arrange
        $ipv6 = '::1';
        $this->ip->setIpv6(false);

        // Act
        $result = $this->ip->validate($ipv6);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - Ip validator with empty value
     * Conditions/Scenarios:
     * - Empty string is provided
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateReturnsTrueWithEmptyValue(): void
    {
        // Arrange
        $emptyValue = '';

        // Act
        $result = $this->ip->validate($emptyValue);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Ip validator with invalid IPv4 address
     * Conditions/Scenarios:
     * - Invalid IPv4 address '256.0.0.1' is provided (256 exceeds max value of 255)
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateReturnsFalseWithInvalidIpv4(): void
    {
        // Arrange
        $ipv4 = '256.0.0.1';

        // Act
        $result = $this->ip->validate($ipv4);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * What is being tested:
     * - Ip validator with valid IPv6 address
     * Conditions/Scenarios:
     * - IPv6 address '::1' is provided
     * Expected results:
     * - Validation passes (returns true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateReturnsTrueWithValidIpv6(): void
    {
        // Arrange
        $ipv6 = '::1';

        // Act
        $result = $this->ip->validate($ipv6);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * What is being tested:
     * - Ip validator with invalid IPv6 address
     * Conditions/Scenarios:
     * - Invalid IPv6 address '2001:0:!23' is provided (contains invalid character '!')
     * Expected results:
     * - Validation fails (returns false)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateReturnsFalseWithInvalidIpv6(): void
    {
        // Arrange
        $ipv6 = '2001:0:!23';

        // Act
        $result = $this->ip->validate($ipv6);

        // Assert
        $this->assertFalse($result);
    }
}
