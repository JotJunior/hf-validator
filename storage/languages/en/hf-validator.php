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
    'error_must_be_datetime' => 'The value must be a DateTime object.',
    'error_must_be_numeric' => 'The value must be a numeric value.',
    'error_must_be_string' => 'The value must be a string value.',
    'error_not_a_string' => 'The provided value is not a string.',

    // Email validator messages
    'error_invalid_email' => 'Invalid email.',
    'error_domain_not_resolvable' => 'The domain name for this email address is not resolvable.',

    // Required validator messages
    'error_field_is_required' => 'This field :field is required.',

    // Password validator messages
    'error_invalid_password' => 'Your password must have :conditions',
    'error_match_lower' => 'one lower case letter',
    'error_match_upper' => 'one upper case letter',
    'error_match_number' => 'one number',
    'error_match_special' => 'one special character',
    'error_length' => 'must be between :min and :max characters long',

    // StringLength validator messages
    'error_min_length' => 'Value must be at least :min characters long',
    'error_max_length' => 'Value must be at most :max characters long',

    // CNPJ validator messages
    'error_invalid_cnpj' => 'Invalid CNPJ.',
    'error_mask_mismatch' => 'The provided value does not match the CNPJ mask.',

    // CPF validator messages
    'error_invalid_cpf' => 'Invalid CPF.',
    'error_malformed_cpf' => 'Invalid CPF',
    'error_cpf_mask_mismatch' => 'The provided value does not match the CPF mask.',

    // Enum validator messages
    'error_invalid_enum' => 'The provided value is not a valid option.',

    // Exists validator messages
    'error_value_does_not_exist' => 'The provided value for :index with value :value does not exist in our records.',

    // Gt, Gte, Lt, Lte validator messages
    'error_must_be_greater_than' => 'Value must be greater than :min.',
    'error_must_be_greater_than_or_equal' => 'Value must be greater than or equal to :min.',
    'error_must_be_less_than' => 'Value must be less than :max.',
    'error_must_be_less_than_or_equal' => 'Value must be less than or equal to :max.',

    // IP validator messages
    'error_invalid_ip' => 'Invalid IP address.',

    // Range validator messages
    'error_value_out_of_range' => 'Value must be between :min and :max.',

    // Regex validator messages
    'error_pattern_mismatch' => 'The provided value does not match the required pattern.',
    'error_invalid_pattern' => 'Invalid pattern. Check the regex syntax.',

    // Unique validator messages
    'error_value_not_unique' => 'The provided value is already in use.',

    // URL validator messages
    'error_invalid_url' => 'Invalid URL.',

    // Phone validator messages
    'error_invalid_phone' => 'Invalid phone number.',

    'error_value_already_used' => 'The given value for :field is already in use.',
    'error_invalid_entity_object' => 'The given value is not a valid Entity object.',

    'error_value_out_of_predefined_list' => 'The given value must be one of the following: :list.',
];
