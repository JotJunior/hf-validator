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

class AT extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::AT;

    protected array $validAreaCodes = [
        // Principais códigos de área da Áustria
        '1', // Viena
        '316', // Graz
        '732', // Linz
        '662', // Salzburgo
        '512', // Innsbruck
        '463', // Klagenfurt
        '7242', // Wels
        '4242', // Villach
        '2742', // Sankt Pölten
        '5572', // Dornbirn
        '2622', // Wiener Neustadt
        '7252', // Steyr
        '5522', // Feldkirch
        '2252', // Baden
        '5574', // Bregenz
        '3842', // Leoben
        '4352', // Wolfsberg
        '2243', // Klosterneuburg
        '2732', // Krems
        '7229', // Traun
    ];
}
