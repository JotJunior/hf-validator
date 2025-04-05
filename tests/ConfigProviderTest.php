<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidatorTest;

use Jot\HfValidator\ConfigProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(ConfigProvider::class)]
class ConfigProviderTest extends TestCase
{
    /**
     * What is being tested:
     * - ConfigProvider's __invoke method returns the expected configuration structure
     * Conditions/Scenarios:
     * - ConfigProvider is instantiated and __invoke method is called
     * Expected results:
     * - Configuration array contains required keys
     * - Translation configuration is properly set up
     */
    #[Test]
    #[Group('unit')]
    public function testInvoke(): void
    {
        $configProvider = new ConfigProvider();
        $config = $configProvider->__invoke();

        // Check that the config array has the expected structure
        $this->assertIsArray($config);
        $this->assertArrayHasKey('annotations', $config);
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertArrayHasKey('commands', $config);
        $this->assertArrayHasKey('listeners', $config);
        $this->assertArrayHasKey('publish', $config);

        // Check the publish configuration for translations
        $this->assertIsArray($config['publish']);

        $hasTranslations = false;
        foreach ($config['publish'] as $publishConfig) {
            if (isset($publishConfig['id']) && $publishConfig['id'] === 'translations') {
                $hasTranslations = true;
                $this->assertArrayHasKey('source', $publishConfig);
                $this->assertArrayHasKey('destination', $publishConfig);
                $this->assertArrayHasKey('merge', $publishConfig);
                $this->assertTrue($publishConfig['merge'], 'Translation files should be merged');
                break;
            }
        }

        $this->assertTrue($hasTranslations, 'Translation publish configuration not found');
    }
}
