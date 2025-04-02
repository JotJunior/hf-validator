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
                    'id' => 'translations',
                    'description' => 'The translation files for hf-validator.',
                    'source' => __DIR__ . '/../storage/languages',
                    'destination' => BASE_PATH . '/storage/languages',
                    'merge' => true, 
                ],
            ],
        ];
    }
}