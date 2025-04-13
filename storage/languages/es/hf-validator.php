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
    'error_must_be_datetime' => 'El valor debe ser un objeto DateTime.',
    'error_must_be_numeric' => 'El valor debe ser numérico.',
    'error_must_be_string' => 'El valor debe ser una cadena de texto.',
    'error_not_a_string' => 'El valor proporcionado no es una cadena de texto.',

    // Email validator messages
    'error_invalid_email' => 'Correo electrónico inválido.',
    'error_domain_not_resolvable' => 'El nombre de dominio para esta dirección de correo no es resoluble.',

    // Required validator messages
    'error_field_is_required' => 'Este campo :field es obligatorio.',

    // Password validator messages
    'error_invalid_password' => 'Su contraseña debe tener :conditions',
    'error_match_lower' => 'una letra minúscula',
    'error_match_upper' => 'una letra mayúscula',
    'error_match_number' => 'un número',
    'error_match_special' => 'un carácter especial',
    'error_length' => 'debe tener entre :min y :max caracteres',

    // StringLength validator messages
    'error_min_length' => 'El valor debe tener al menos :min caracteres',
    'error_max_length' => 'El valor debe tener como máximo :max caracteres',

    // CNPJ validator messages
    'error_invalid_cnpj' => 'CNPJ inválido.',
    'error_mask_mismatch' => 'El valor proporcionado no coincide con la máscara de CNPJ.',

    // CPF validator messages
    'error_invalid_cpf' => 'CPF inválido.',
    'error_cpf_mask_mismatch' => 'El valor proporcionado no coincide con la máscara de CPF.',

    // Enum validator messages
    'error_invalid_enum' => 'El valor proporcionado no es una opción válida.',

    // Exists validator messages
    'error_value_does_not_exist' => 'El valor proporcionado no existe en nuestros registros.',

    // Gt, Gte, Lt, Lte validator messages
    'error_must_be_greater_than' => 'El valor debe ser mayor que :min.',
    'error_must_be_greater_than_or_equal' => 'El valor debe ser mayor o igual a :min.',
    'error_must_be_less_than' => 'El valor debe ser menor que :max.',
    'error_must_be_less_than_or_equal' => 'El valor debe ser menor o igual a :max.',

    // IP validator messages
    'error_invalid_ip' => 'Dirección IP inválida.',

    // Range validator messages
    'error_value_out_of_range' => 'El valor debe estar entre :min y :max.',

    // Regex validator messages
    'error_pattern_mismatch' => 'El valor proporcionado no coincide con el patrón requerido.',
    'error_invalid_pattern' => 'Patrón inválido. Verifique la sintaxis de la expresión regular.',

    // Unique validator messages
    'error_value_not_unique' => 'El valor proporcionado ya está en uso.',

    // URL validator messages
    'error_invalid_url' => 'URL inválida.',

    // Phone validator messages
    'error_invalid_phone' => 'Número de teléfono inválido.',

    'error_value_already_used' => 'El valor dado para :field ya está en uso.',
    'error_invalid_entity_object' => 'El valor dado no es un objeto Entity válido.',

    'error_value_out_of_predefined_list' => 'El valor dado debe ser uno de los siguientes: :list.',
];