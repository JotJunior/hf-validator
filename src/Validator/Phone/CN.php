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

class CN extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::CN;

    protected array $validAreaCodes = [
        // Prefixos móveis
        '13', // China Mobile
        '14', // China Mobile
        '15', // China Mobile, China Unicom
        '16', // China Unicom
        '17', // China Unicom, China Telecom
        '18', // China Mobile, China Unicom, China Telecom
        '19', // China Telecom

        // Códigos de área para grandes cidades
        '10', // Beijing
        '20', // Guangzhou
        '21', // Shanghai
        '22', // Tianjin
        '23', // Chongqing
        '24', // Shenyang
        '25', // Nanjing
        '27', // Wuhan
        '28', // Chengdu
        '29', // Xi'an
        '311', // Shijiazhuang
        '351', // Taiyuan
        '371', // Zhengzhou
        '411', // Dalian
        '431', // Changchun
        '451', // Harbin
        '471', // Hohhot
        '510', // Wuxi
        '512', // Suzhou
        '531', // Jinan
        '532', // Qingdao
        '551', // Hefei
        '571', // Hangzhou
        '591', // Fuzhou
        '592', // Xiamen
        '731', // Changsha
        '755', // Shenzhen
        '771', // Nanning
        '791', // Nanchang
        '851', // Guiyang
        '871', // Kunming
        '898', // Haikou
    ];
}
