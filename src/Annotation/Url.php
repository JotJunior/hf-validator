<?php

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
 * @property array $customErrorMessages Custom error messages to be used for specific validation failures.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Url extends AbstractAnnotation
{

    public function __construct(
        public bool  $forceHttps = false,
        public bool  $checkDomain = false,
        public array $customErrorMessages = [
            'ERROR_INVALID_URL' => null,
            'ERROR_URL_MUST_USE_HTTPS_SCHEME' => null,
            'ERROR_DOMAIN_NOT_RESOLVABLE' => null,
        ]
    )
    {
    }

}

