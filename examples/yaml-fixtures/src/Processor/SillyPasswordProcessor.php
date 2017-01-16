<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\AbstractPathProcessor;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

class SillyPasswordProcessor extends AbstractPathProcessor
{
    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return 'password';
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        return hash('sha512', $payload);
    }
}
