<?php

declare(strict_types=1);

namespace Jot\HfUtils;

use Jot\HfValidator\BootValidatorListener;

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