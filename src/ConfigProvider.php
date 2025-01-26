<?php

declare(strict_types=1);

namespace Jot\HfValidator;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [],
            'commands' => [],
            'listeners' => [
                BootValidatorListener::class
            ],
            'publish' => [],
        ];
    }
}