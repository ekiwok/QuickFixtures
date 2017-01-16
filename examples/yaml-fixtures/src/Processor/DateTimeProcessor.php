<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;
use Ekiwok\QuickFixtures\Processor\PrioritisedProcessorInterface;

class DateTimeProcessor implements PrioritisedProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 1024;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        return new \DateTime($payload);
    }

    /**
     * {@inheritdoc}
     */
    public function applies(ContextInterface $context, $payload)
    {
        $type = $context->getType();

        return $type->hasAnyClass()
            && $type->hasClass(\DateTime::class)
            && is_string($payload);
    }
}
