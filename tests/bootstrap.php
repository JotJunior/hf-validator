<?php

declare(strict_types=1);

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');

error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

!defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

// Load the Composer autoloader
require BASE_PATH . '/vendor/autoload.php';

// Load test helpers (including mock for __ function)
require __DIR__ . '/helpers.php';
