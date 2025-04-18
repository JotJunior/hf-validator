<?php

declare(strict_types=1);
/**
 * This file is part of the hf_validator module, a package build for Hyperf framework that is responsible validate the entities properties.
 *
 * @author   Joao Zanon <jot@jot.com.br>
 * @link     https://github.com/JotJunior/hf-validator
 * @license  MIT
 */

namespace Jot\HfValidator\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * Represents an annotation for validating URLs.
 *
 * This class is used to specify constraints for URLs, such as enforcing HTTPS,
 * checking the domain resolvability, and defining custom error messages for
 * validation failures.
 *
 * @property bool $forceHttps Determines if the URL should be enforced to use HTTPS.
 * @property bool $checkDomain Specifies if the URL's domain should be checked for resolvability.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Url extends AbstractAnnotation
{
    public function __construct(
        public bool $forceHttps = false,
        public bool $checkDomain = false
    ) {
    }
}
