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
        return 1024;
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
