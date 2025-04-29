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
    'error_must_be_datetime' => 'O valor deve ser um objeto DateTime.',
    'error_must_be_numeric' => 'O valor deve ser numérico.',
    'error_must_be_string' => 'O valor deve ser uma string.',
    'error_not_a_string' => 'O valor fornecido não é uma string.',

    // Email validator messages
    'error_invalid_email' => 'Email inválido.',
    'error_domain_not_resolvable' => 'O nome de domínio para este endereço de email não é resolvível.',

    // Required validator messages
    'error_field_is_required' => 'O campo :field é obrigatório.',

    // Password validator messages
    'error_invalid_password' => 'Sua senha deve ter :conditions',
    'error_match_lower' => 'uma letra minúscula',
    'error_match_upper' => 'uma letra maiúscula',
    'error_match_number' => 'um número',
    'error_match_special' => 'um caractere especial',
    'error_length' => 'deve ter entre :min e :max caracteres',

    // StringLength validator messages
    'error_min_length' => 'O valor deve ter pelo menos :min caracteres',
    'error_max_length' => 'O valor deve ter no máximo :max caracteres',

    // CNPJ validator messages
    'error_invalid_cnpj' => 'CNPJ inválido.',
    'error_mask_mismatch' => 'O valor fornecido não corresponde à máscara de CNPJ.',

    // CPF validator messages
    'error_invalid_cpf' => 'CPF inválido.',
    'error_malformed_cpf' => 'CPF inválido',
    'error_cpf_mask_mismatch' => 'O valor fornecido não corresponde à máscara de CPF.',

    // Enum validator messages
    'error_invalid_enum' => 'O valor fornecido não é uma opção válida.',

    // Exists validator messages
    'error_value_does_not_exist' => 'O valor fornecido não existe em nossos registros.',

    // Gt, Gte, Lt, Lte validator messages
    'error_must_be_greater_than' => 'O valor deve ser maior que :min.',
    'error_must_be_greater_than_or_equal' => 'O valor deve ser maior ou igual a :min.',
    'error_must_be_less_than' => 'O valor deve ser menor que :max.',
    'error_must_be_less_than_or_equal' => 'O valor deve ser menor ou igual a :max.',

    // IP validator messages
    'error_invalid_ip' => 'Endereço IP inválido.',

    // Range validator messages
    'error_value_out_of_range' => 'O valor deve estar entre :min e :max.',

    // Regex validator messages
    'error_pattern_mismatch' => 'O valor fornecido não corresponde ao padrão exigido.',

    // Unique validator messages
    'error_value_not_unique' => 'O valor fornecido já está em uso.',

    // URL validator messages
    'error_invalid_url' => 'URL inválida.',

    // Phone validator messages
    'error_invalid_phone' => 'Número de telefone inválido.',

    'error_value_already_used' => 'O valor dado ao campo :field já foi utilizado.',
    'error_invalid_entity_object' => 'O valor fornecido não é um objeto de entidade válido.',

    'error_value_out_of_predefined_list' => 'O valor fornecido deve ser um dos seguintes: :list.',
];
