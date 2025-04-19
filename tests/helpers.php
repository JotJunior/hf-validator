<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

use Hyperf\Context\ApplicationContext;
use Mockery\MockInterface;
use Psr\Container\ContainerInterface;
use Hyperf\Contract\TranslatorInterface;

// Mock the container and translator for tests
$container = Mockery::mock(ContainerInterface::class);
$translator = Mockery::mock(TranslatorInterface::class);

// Setup the translator mock to return the translation key as is
$translator->shouldReceive('trans')->andReturnUsing(function ($key) {
    return $key;
});

// Setup the container to return our translator mock
$container->shouldReceive('get')->with(TranslatorInterface::class)->andReturn($translator);

// Set the mocked container in the ApplicationContext
ApplicationContext::setContainer($container);
