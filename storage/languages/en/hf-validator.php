<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */
return [
    // AbstractValidator messages
    'ERROR_MUST_BE_DATETIME' => 'The value must be a DateTime object.',
    'ERROR_MUST_BE_NUMERIC' => 'The value must be a numeric value.',
    'ERROR_MUST_BE_STRING' => 'The value must be a string value.',
    'ERROR_NOT_A_STRING' => 'The provided value is not a string.',

    // Email validator messages
    'ERROR_INVALID_EMAIL' => 'Invalid email.',
    'ERROR_DOMAIN_NOT_RESOLVABLE' => 'The domain name for this email address is not resolvable.',

    // Required validator messages
    'ERROR_FIELD_IS_REQUIRED' => 'This field is required.',

    // Password validator messages
    'ERROR_INVALID_PASSWORD' => 'Your password must have at least %s and be between %s and %s characters long.',
    'ERROR_MATCH_LOWER' => 'one lower case letter',
    'ERROR_MATCH_UPPER' => 'one upper case letter',
    'ERROR_MATCH_NUMBER' => 'one number',
    'ERROR_MATCH_SPECIAL' => 'one special character',
    'ERROR_LENGTH' => 'between %s and %s characters long',

    // StringLength validator messages
    'ERROR_MIN_LENGTH' => 'Value must be at least %s characters long',
    'ERROR_MAX_LENGTH' => 'Value must be at most %s characters long',

    // CNPJ validator messages
    'ERROR_INVALID_CNPJ' => 'Invalid CNPJ.',
    'ERROR_MASK_MISMATCH' => 'The provided value does not match the CNPJ mask.',

    // CPF validator messages
    'ERROR_INVALID_CPF' => 'Invalid CPF.',
    'ERROR_CPF_MASK_MISMATCH' => 'The provided value does not match the CPF mask.',

    // Enum validator messages
    'ERROR_INVALID_ENUM' => 'The provided value is not a valid option.',

    // Exists validator messages
    'ERROR_VALUE_DOES_NOT_EXIST' => 'The provided value does not exist in our records.',

    // Gt, Gte, Lt, Lte validator messages
    'ERROR_MUST_BE_GREATER_THAN' => 'Value must be greater than %s.',
    'ERROR_MUST_BE_GREATER_THAN_OR_EQUAL' => 'Value must be greater than or equal to %s.',
    'ERROR_MUST_BE_LESS_THAN' => 'Value must be less than %s.',
    'ERROR_MUST_BE_LESS_THAN_OR_EQUAL' => 'Value must be less than or equal to %s.',

    // IP validator messages
    'ERROR_INVALID_IP' => 'Invalid IP address.',

    // Range validator messages
    'ERROR_VALUE_OUT_OF_RANGE' => 'Value must be between %s and %s.',

    // Regex validator messages
    'ERROR_PATTERN_MISMATCH' => 'The provided value does not match the required pattern.',

    // Unique validator messages
    'ERROR_VALUE_NOT_UNIQUE' => 'The provided value is already in use.',

    // URL validator messages
    'ERROR_INVALID_URL' => 'Invalid URL.',

    // Phone validator messages
    'ERROR_INVALID_PHONE' => 'Invalid phone number.',
];
