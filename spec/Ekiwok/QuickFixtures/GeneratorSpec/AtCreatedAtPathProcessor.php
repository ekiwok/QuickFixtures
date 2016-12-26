<?php

namespace spec\Ekiwok\QuickFixtures\GeneratorSpec;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\AbstractPathProcessor;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

class AtCreatedAtPathProcessor extends AbstractPathProcessor
{
    /**
     * @return string
     */
    protected function getPath()
    {
        return 'createdAt';
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        return new \stdClass();
    }
}
