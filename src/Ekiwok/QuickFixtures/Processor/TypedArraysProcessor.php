<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context;
use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\Generator\UnsupportedContextException;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

class TypedArraysProcessor implements PrioritisedProcessorInterface
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
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        if (!is_array($payload)) {
            throw UnsupportedPayloadException::create(self::class, gettype($payload));
        }

        $types = $context->getType()->getTypedArrays();
        $throwedExceptions = [];

        foreach ($types as $type) {
            try {
                $result = [];
                $context = new Context($type, $context->getPath());
                foreach ($payload as $payloadElement) {
                    $result[] = $generator->generate($context, $payloadElement);
                }

                return $result;
            } catch (UnsupportedContextException $e) {
                $throwedExceptions[] = $e;
            }
        }

        throw new UnsupportedContextException(self::class, $context->getPath(), ...$throwedExceptions);
    }

    /**
     * {@inheritdoc}
     */
    public function applies(ContextInterface $context, $payload)
    {
        if (!is_array($payload)) {
            return false;
        }

        $type = $context->getType();
        $types = $type->getTypedArrays();

        return !empty($types);
    }
}
