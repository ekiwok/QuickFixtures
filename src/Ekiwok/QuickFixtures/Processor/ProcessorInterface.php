<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;

interface ProcessorInterface
{
    /**
     * @param ContextInterface $context
     * @param mixed $payload
     * @param GeneratorInterface $generator
     *
     * @return mixed
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator);

    /**
     * @param ContextInterface $context
     * @param mixed $payload
     *
     * @return mixed
     */
    public function applies(ContextInterface $context, $payload);
}
