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

use Jot\HfElastic\Contracts\QueryBuilderInterface;
use Jot\HfValidator\Validator\Url;
use Mockery;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

/**
 * What is being tested:
 * - URL validator functionality
 * - URL validation with various configurations (HTTPS enforcement, domain checking)
 * Conditions/Scenarios:
 * - Empty values
 * - Invalid URLs
 * - Valid URLs
 * - URLs with HTTPS enforcement
 * - URLs with domain resolution checking
 * Expected results:
 * - Empty values should be considered valid
 * - Invalid URLs should be rejected with appropriate error messages
 * - Valid URLs should be accepted
 * - When HTTPS is enforced, non-HTTPS URLs should be rejected
 * - When domain checking is enabled, non-resolvable domains should be rejected
 */
#[CoversClass(Url::class)]
#[Group('unit')]
class UrlTest extends TestCase
{
    private QueryBuilderInterface $queryBuilder;

    private Url $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->queryBuilder = Mockery::mock(QueryBuilderInterface::class);
        $this->validator = new Url($this->queryBuilder);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * What is being tested:
     * - Validation of empty values
     * Conditions/Scenarios:
     * - Empty string
     * - Null value
     * Expected results:
     * - Empty values should be considered valid (return true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateEmptyValueReturnsTrue(): void
    {
        // Arrange
        // Act & Assert
        $this->assertTrue($this->validator->validate(''));
        $this->assertTrue($this->validator->validate(null));
    }

    /**
     * What is being tested:
     * - Validation of invalid URLs
     * Conditions/Scenarios:
     * - Non-URL string
     * - Incomplete URL (http:// only)
     * - Domain without scheme
     * Expected results:
     * - Invalid URLs should be rejected with appropriate error messages
     */
    #[Test]
    #[Group('unit')]
    public function testValidateInvalidUrlReturnsFalse(): void
    {
        // Arrange
        // Act & Assert
        $this->assertFalse($this->validator->validate('not-a-url'));
        $errors = $this->validator->consumeErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('hf-validator.error_invalid_url', $errors[0]);

        $this->assertFalse($this->validator->validate('http://'));
        $errors = $this->validator->consumeErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('hf-validator.error_invalid_url', $errors[0]);

        $this->assertFalse($this->validator->validate('example.com'));
        $errors = $this->validator->consumeErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('hf-validator.error_invalid_url', $errors[0]);
    }

    /**
     * What is being tested:
     * - Validation of valid URLs
     * Conditions/Scenarios:
     * - HTTP URL
     * - HTTPS URL
     * - URL with path, query parameters, and fragment
     * Expected results:
     * - Valid URLs should be accepted (return true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateValidUrlReturnsTrue(): void
    {
        // Arrange
        // Act & Assert
        $this->assertTrue($this->validator->validate('http://example.com'));
        $this->assertTrue($this->validator->validate('https://example.com'));
        $this->assertTrue($this->validator->validate('https://example.com/path?query=value#fragment'));
    }

    /**
     * What is being tested:
     * - Validation with HTTPS enforcement
     * Conditions/Scenarios:
     * - HTTP URL with HTTPS enforcement enabled
     * Expected results:
     * - Non-HTTPS URLs should be rejected with appropriate error message
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithForceHttpsReturnsFalseForNonHttpsUrl(): void
    {
        // Arrange
        $this->validator->setForceHttps(true);

        // Act & Assert
        $this->assertFalse($this->validator->validate('http://example.com'));
        $errors = $this->validator->consumeErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('hf-validator.error_url_must_use_https_scheme', $errors[0]);
    }

    /**
     * What is being tested:
     * - Validation with HTTPS enforcement
     * Conditions/Scenarios:
     * - HTTPS URL with HTTPS enforcement enabled
     * Expected results:
     * - HTTPS URLs should be accepted (return true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithForceHttpsReturnsTrueForHttpsUrl(): void
    {
        // Arrange
        $this->validator->setForceHttps(true);

        // Act & Assert
        $this->assertTrue($this->validator->validate('https://example.com'));
    }

    /**
     * What is being tested:
     * - Validation with domain checking
     * Conditions/Scenarios:
     * - URL with unresolvable domain and domain checking enabled
     * Expected results:
     * - URLs with unresolvable domains should be rejected with appropriate error message
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithCheckDomainReturnsFalseForUnresolvableDomain(): void
    {
        // Arrange
        $this->validator->setCheckDomain(true);

        // Act & Assert
        // Using a domain that is unlikely to be resolvable
        $this->assertFalse($this->validator->validate('https://this-domain-does-not-exist-12345.com'));
        $errors = $this->validator->consumeErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('hf-validator.error_domain_not_resolvable', $errors[0]);
    }

    /**
     * What is being tested:
     * - Validation with domain checking
     * Conditions/Scenarios:
     * - URL with resolvable domain and domain checking enabled
     * Expected results:
     * - URLs with resolvable domains should be accepted (return true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithCheckDomainReturnsTrueForResolvableDomain(): void
    {
        // Arrange
        $this->validator->setCheckDomain(true);

        // Act & Assert
        // Using a domain that is likely to be resolvable
        $this->assertTrue($this->validator->validate('https://google.com'));
    }

    /**
     * What is being tested:
     * - Validation with both HTTPS enforcement and domain checking
     * Conditions/Scenarios:
     * - HTTP URL with resolvable domain, with both HTTPS enforcement and domain checking enabled
     * Expected results:
     * - Non-HTTPS URLs should be rejected even if domain is resolvable
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithForceHttpsAndCheckDomainReturnsFalseForNonHttpsResolvableDomain(): void
    {
        // Arrange
        $this->validator->setForceHttps(true)
            ->setCheckDomain(true);

        // Act & Assert
        $this->assertFalse($this->validator->validate('http://google.com'));
        $errors = $this->validator->consumeErrors();
        $this->assertCount(1, $errors);
        $this->assertEquals('hf-validator.error_url_must_use_https_scheme', $errors[0]);
    }

    /**
     * What is being tested:
     * - Validation with both HTTPS enforcement and domain checking
     * Conditions/Scenarios:
     * - HTTPS URL with resolvable domain, with both HTTPS enforcement and domain checking enabled
     * Expected results:
     * - HTTPS URLs with resolvable domains should be accepted (return true)
     */
    #[Test]
    #[Group('unit')]
    public function testValidateWithForceHttpsAndCheckDomainReturnsTrueForHttpsResolvableDomain(): void
    {
        // Arrange
        $this->validator->setForceHttps(true)
            ->setCheckDomain(true);

        // Act & Assert
        $this->assertTrue($this->validator->validate('https://google.com'));
    }
}
