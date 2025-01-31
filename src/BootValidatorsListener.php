<?php

declare(strict_types=1);

namespace Jot\HfValidator;

use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\BootApplication;
use Psr\Container\ContainerInterface;

#[Listener]
class BootValidatorsListener implements ListenerInterface
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

    /**
     * Processes a given event by iterating through all registered validators and applying them.
     *
     * @param object $event The event object to be processed by the validators.
     * @return void
     */
    public function process(object $event): void
    {
        foreach ($this->getValidators() as $validator) {
            $this->processValidator($validator, $event);
        }
    }

    /**
     * Retrieves an array of validators available for use.
     *
     * @return array An array of validator class names, each representing a specific type of validation logic.
     */
    private function getValidators(): array
    {
        return [
            Annotation\CNPJ::class,
            Annotation\CPF::class,
            Annotation\Exists::class,
            Annotation\Email::class,
            Annotation\Enum::class,
            Annotation\Gt::class,
            Annotation\Gte::class,
            Annotation\Ip::class,
            Annotation\StringLength::class,
            Annotation\Lt::class,
            Annotation\Lte::class,
            Annotation\Password::class,
            Annotation\Phone::class,
            Annotation\Range::class,
            Annotation\Regex::class,
            Annotation\Required::class,
            Annotation\Unique::class,
            Annotation\Url::class,
        ];
    }

    /**
     * Processes a validator by collecting properties annotated with the given validator class and applying them to the specified event.
     *
     * @param string $validatorClass The fully qualified class name of the validator to be processed.
     * @param object $event The event object to which the collected validators will be applied.
     * @return void
     */
    private function processValidator(string $validatorClass, object $event): void
    {
        $collectedAnnotations = AnnotationCollector::getPropertiesByAnnotation($validatorClass);
        foreach ($collectedAnnotations as $annotationData) {
            ValidatorChain::addTarget(
                $annotationData['class'],
                $annotationData['property'],
                $annotationData['annotation']
            );
        }
    }

}
