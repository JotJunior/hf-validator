<?php

declare(strict_types=1);

namespace Jot\HfValidator;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'dependencies' => [],
            'commands' => [],
            'listeners' => [
                BootValidatorsListener::class
            ],
            'publish' => [
                [
                    'id' => 'translations-en',
                    'description' => 'The english translation files for hf-validator.',
                    'source' => __DIR__ . '/../storage/languages/en/hf-validator.php',
                    'destination' => BASE_PATH . '/storage/languages/hf-validator/en.php',
                ],
                [
                    'id' => 'translations-pt_BR',
                    'description' => 'The brazilian portuguese translation files for hf-validator.',
                    'source' => __DIR__ . '/../storage/languages/pt_BR/hf-validator.php',
                    'destination' => BASE_PATH . '/storage/languages/pt_BR/hf-validator.php',
                ],
            ],
        ];
    }
}
