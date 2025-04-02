<?php

declare(strict_types=1);

/**
 * Mock for the Hyperf translation function
 * This function simulates the behavior of the global __() function in Hyperf
 * for testing purposes.
 *
 * @param string $key The translation key
 * @param array $replace Values to replace placeholders
 * @param string|null $locale The locale to use
 * @return string The translated string or the key if no translation is found
 */
if (!function_exists('__')) {
    function __(string $key, array $replace = [], ?string $locale = null): string
    {
        // For testing, we'll just return the key or apply replacements to default messages
        // This simulates what happens when a translation is not found
        return $key;
    }
}
