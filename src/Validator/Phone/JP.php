<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Validator\Phone;

use Jot\HfValidator\Validator\AbstractPhoneValidator;
use Jot\HfValidator\Validator\CountryPhoneInterface;
use Jot\HfValidator\Validator\CountryPhonePatterns;

class JP extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::JP;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '70', // Operadoras móveis
        '80', // Operadoras móveis
        '90', // Operadoras móveis

        // Códigos de área fixos
        '1', // Hokkaido
        '2', // Tohoku
        '3', // Tokyo
        '4', // Kanto
        '5', // Chubu
        '6', // Osaka, Kyoto
        '7', // Chugoku
        '8', // Shikoku
        '9', // Kyushu

        // Serviços especiais
        '11', // Sapporo
        '22', // Sendai
        '33', // Tokyo
        '44', // Yokohama
        '52', // Nagoya
        '66', // Osaka
        '75', // Kyoto
        '77', // Kanazawa
        '82', // Hiroshima
        '88', // Takamatsu
        '92', // Fukuoka
        '93', // Kitakyushu
        '95', // Nagasaki
        '96', // Kumamoto
        '98', // Naha
        '99', // Kagoshima
        '120', // Números gratuitos
        '800', // Números gratuitos
    ];
}
