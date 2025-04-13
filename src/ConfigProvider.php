<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

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
                BootValidatorsListener::class,
            ],
            'publish' => [
                [
                    'id' => 'translations-en',
                    'description' => 'The english translation files for hf-validator.',
                    'source' => __DIR__ . '/../storage/languages/en/hf-validator.php',
                    'destination' => BASE_PATH . '/storage/languages/en/hf-validator.php',
                ],
                [
                    'id' => 'translations-es',
                    'description' => 'The spanish translation files for hf-validator.',
                    'source' => __DIR__ . '/../storage/languages/es/hf-validator.php',
                    'destination' => BASE_PATH . '/storage/languages/es/hf-validator.php',
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
