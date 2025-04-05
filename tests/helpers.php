<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */
if (! function_exists('__')) {
    function __(string $key, array $replace = [], ?string $locale = null): string
    {
        // For testing, we'll just return the key or apply replacements to default messages
        // This simulates what happens when a translation is not found
        return $key;
    }
}
