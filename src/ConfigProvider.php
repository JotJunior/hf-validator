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
            'publish' => [],
        ];
    }
}