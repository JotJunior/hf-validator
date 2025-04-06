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

class CA extends AbstractPhoneValidator implements CountryPhoneInterface
{
    protected CountryPhonePatterns $pattern = CountryPhonePatterns::US_CA;

    protected array $validAreaCodes = [
        // Canadian area codes
        204, 226, 236, 249, 250, 289, 306, 343, 365, 367, 368, 382, 387, 403, 416, 418, 428, 431, 437, 438,
        450, 468, 474, 506, 514, 519, 548, 579, 581, 584, 587, 604, 613, 639, 647, 672, 683, 705, 709, 742,
        753, 778, 780, 782, 807, 819, 825, 867, 871, 873, 879, 902, 905,
    ];
}
