<?php

declare(strict_types=1);

namespace Jot\HfValidatorTest;

use Jot\HfValidator\ConfigProvider;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    /**
     * Test that the ConfigProvider returns the expected configuration
     */
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
