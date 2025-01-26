<?php

declare(strict_types=1);

namespace Jot\HfValidator;

use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Framework\Event\BootApplication;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class BootValidatorListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            BootApplication::class,
        ];
    }

    public function process(object $event): void
    {
        $annotations = [
            CNPJ::class,
            CPF::class,
            Phone::class,
            Elastic::class,
        ];

        foreach ($annotations as $annotation) {
            $validators = AnnotationCollector::getPropertiesByAnnotation($annotation);
            print_r($validators);
        }
    }
}
