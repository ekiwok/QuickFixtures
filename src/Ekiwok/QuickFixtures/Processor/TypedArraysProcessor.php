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
        return 255;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        $types = $context->getType()->getTypedArrays();

        if (!is_array($payload)) {
            throw UnsupportedPayloadException::create(self::class, gettype($payload));
        }

        foreach ($types as $type) {
            try {
                $result = [];
                $context = new Context($type, $context->getPath());
                foreach ($payload as $payloadElement) {
                    $result[] = $generator->generate($context, $payloadElement);
                }

                return $result;
            } catch (UnsupportedContextException $e) {
                // try again
            }
        }

        throw new UnsupportedContextException(self::class, $context->getPath());
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
