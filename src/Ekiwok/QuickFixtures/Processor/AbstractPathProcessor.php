<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

abstract class AbstractPathProcessor implements PrioritisedProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return self::BUILT_IN_PROCESSORS_PRIORITIES[self::class];
    }

    /**
     * {@inheritdoc}
     */
    public function applies(ContextInterface $context, $payload)
    {
        $path = $context->getPath();

        return $this->getPath() === $path->__toString();
    }

    /**
     * @return string
     */
    abstract protected function getPath();
}
