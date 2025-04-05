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
use Jot\HfValidator\Validator\Url;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Url::class)]
class UrlTest extends TestCase
{
    private Url $urlValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->urlValidator = new Url($queryBuilder);
    }

    /**
     * What is being tested:
     * - Url validator with valid URLs under different validation settings
     * Conditions/Scenarios:
     * - Testing with checkDomain=false, forceHttps=false
     * - Testing with checkDomain=true, forceHttps=false
     * - Testing with checkDomain=false, forceHttps=true
     * - Testing with checkDomain=true, forceHttps=true
     * Expected results:
     * - All validations pass (return true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateValidUrls(): void
    {
        // Arrange & Act & Assert for multiple scenarios

        // Scenario 1: checkDomain=false, forceHttps=false
        $result1 = $this->urlValidator->setCheckDomain(false)->setForceHttps(false)->validate('http://google.com');
        $errors1 = $this->urlValidator->consumeErrors();
        $this->assertTrue($result1);
        $this->assertEmpty($errors1);

        // Scenario 2: checkDomain=true, forceHttps=false
        $result2 = $this->urlValidator->setCheckDomain(true)->setForceHttps(false)->validate('http://google.com');
        $errors2 = $this->urlValidator->consumeErrors();
        $this->assertTrue($result2);
        $this->assertEmpty($errors2);

        // Scenario 3: checkDomain=false, forceHttps=true
        $result3 = $this->urlValidator->setCheckDomain(false)->setForceHttps(true)->validate('https://google.com');
        $errors3 = $this->urlValidator->consumeErrors();
        $this->assertTrue($result3);
        $this->assertEmpty($errors3);

        // Scenario 4: checkDomain=true, forceHttps=true
        $result4 = $this->urlValidator->setCheckDomain(true)->setForceHttps(true)->validate('https://google.com');
        $errors4 = $this->urlValidator->consumeErrors();
        $this->assertTrue($result4);
        $this->assertEmpty($errors4);
    }

    /**
     * What is being tested:
     * - Url validator with invalid URLs under different validation settings
     * Conditions/Scenarios:
     * - Testing with invalid URL format
     * - Testing with malformed URL (missing slashes)
     * - Testing HTTP URL when HTTPS is required
     * - Testing with non-existent domain when domain checking is enabled
     * Expected results:
     * - All validations fail (return false)
     * - Error messages are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateInvalidUrls(): void
    {
        // Arrange & Act & Assert for multiple scenarios

        // Scenario 1: Invalid URL format
        $result1 = $this->urlValidator->setCheckDomain(false)->setForceHttps(false)->validate('invalid url');
        $errors1 = $this->urlValidator->consumeErrors();
        $this->assertFalse($result1);
        $this->assertNotEmpty($errors1);

        // Scenario 2: Malformed URL (missing slashes)
        $result2 = $this->urlValidator->setCheckDomain(false)->setForceHttps(false)->validate('http:google.com');
        $errors2 = $this->urlValidator->consumeErrors();
        $this->assertFalse($result2);
        $this->assertNotEmpty($errors2);

        // Scenario 3: HTTP URL when HTTPS is required
        $result3 = $this->urlValidator->setCheckDomain(false)->setForceHttps(true)->validate('http://google.com');
        $errors3 = $this->urlValidator->consumeErrors();
        $this->assertFalse($result3);
        $this->assertNotEmpty($errors3);

        // Scenario 4: Non-existent domain when domain checking is enabled
        $result4 = $this->urlValidator->setCheckDomain(true)->setForceHttps(false)->validate('http://nonexistentdomain123.com');
        $errors4 = $this->urlValidator->consumeErrors();
        $this->assertFalse($result4);
        $this->assertNotEmpty($errors4);
    }

    /**
     * What is being tested:
     * - Url validator with an empty value
     * Conditions/Scenarios:
     * - Empty string is provided as input
     * Expected results:
     * - Validation passes (returns true)
     * - No errors are generated
     */
    #[Test]
    #[Group('unit')]
    public function testValidateEmptyValue(): void
    {
        // Arrange
        $this->urlValidator->setCheckDomain(false)->setForceHttps(false);
        $emptyValue = '';

        // Act
        $result = $this->urlValidator->validate($emptyValue);
        $errors = $this->urlValidator->consumeErrors();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($errors);
    }
}
