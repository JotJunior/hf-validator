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
    'ERROR_MUST_BE_DATETIME' => 'O valor deve ser um objeto DateTime.',
    'ERROR_MUST_BE_NUMERIC' => 'O valor deve ser numérico.',
    'ERROR_MUST_BE_STRING' => 'O valor deve ser uma string.',
    'ERROR_NOT_A_STRING' => 'O valor fornecido não é uma string.',

    // Email validator messages
    'ERROR_INVALID_EMAIL' => 'Email inválido.',
    'ERROR_DOMAIN_NOT_RESOLVABLE' => 'O nome de domínio para este endereço de email não é resolvível.',

    // Required validator messages
    'ERROR_FIELD_IS_REQUIRED' => 'Este campo é obrigatório.',

    // Password validator messages
    'ERROR_INVALID_PASSWORD' => 'Sua senha deve ter pelo menos %s e ter entre %s e %s caracteres.',
    'ERROR_MATCH_LOWER' => 'uma letra minúscula',
    'ERROR_MATCH_UPPER' => 'uma letra maiúscula',
    'ERROR_MATCH_NUMBER' => 'um número',
    'ERROR_MATCH_SPECIAL' => 'um caractere especial',
    'ERROR_LENGTH' => 'entre %s e %s caracteres',

    // StringLength validator messages
    'ERROR_MIN_LENGTH' => 'O valor deve ter pelo menos %s caracteres',
    'ERROR_MAX_LENGTH' => 'O valor deve ter no máximo %s caracteres',

    // CNPJ validator messages
    'ERROR_INVALID_CNPJ' => 'CNPJ inválido.',
    'ERROR_MASK_MISMATCH' => 'O valor fornecido não corresponde à máscara de CNPJ.',

    // CPF validator messages
    'ERROR_INVALID_CPF' => 'CPF inválido.',
    'ERROR_CPF_MASK_MISMATCH' => 'O valor fornecido não corresponde à máscara de CPF.',

    // Enum validator messages
    'ERROR_INVALID_ENUM' => 'O valor fornecido não é uma opção válida.',

    // Exists validator messages
    'ERROR_VALUE_DOES_NOT_EXIST' => 'O valor fornecido não existe em nossos registros.',

    // Gt, Gte, Lt, Lte validator messages
    'ERROR_MUST_BE_GREATER_THAN' => 'O valor deve ser maior que %s.',
    'ERROR_MUST_BE_GREATER_THAN_OR_EQUAL' => 'O valor deve ser maior ou igual a %s.',
    'ERROR_MUST_BE_LESS_THAN' => 'O valor deve ser menor que %s.',
    'ERROR_MUST_BE_LESS_THAN_OR_EQUAL' => 'O valor deve ser menor ou igual a %s.',

    // IP validator messages
    'ERROR_INVALID_IP' => 'Endereço IP inválido.',

    // Range validator messages
    'ERROR_VALUE_OUT_OF_RANGE' => 'O valor deve estar entre %s e %s.',

    // Regex validator messages
    'ERROR_PATTERN_MISMATCH' => 'O valor fornecido não corresponde ao padrão exigido.',

    // Unique validator messages
    'ERROR_VALUE_NOT_UNIQUE' => 'O valor fornecido já está em uso.',

    // URL validator messages
    'ERROR_INVALID_URL' => 'URL inválida.',

    // Phone validator messages
    'ERROR_INVALID_PHONE' => 'Número de telefone inválido.',
];
