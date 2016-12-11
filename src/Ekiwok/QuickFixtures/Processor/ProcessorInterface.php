<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

interface ProcessorInterface
{
    /**
     * @param ContextInterface $context
     * @param mixed $payload
     * @param GeneratorInterface $generator
     *
     * @return mixed
     *
     * @throws UnsupportedPayloadException
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
