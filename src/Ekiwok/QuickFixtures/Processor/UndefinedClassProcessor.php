<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;

/**
 * This processor handles any class (this is why it's UndefinedClassProcessor in contrary to fe. DateTimeProcessor).
 */
class UndefinedClassProcessor implements PrioritisedProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        // TODO: Implement process() method.
    }

    /**
     * @param ContextInterface $context
     * @param mixed $payload
     *
     * @return mixed
     */
    public function applies(ContextInterface $context, $payload)
    {
        if (!$context->getType()->hasAnyClass()) {
            return false;
        }

        switch (gettype($payload))
        {
            case 'array':
            case 'NULL':
                return true;

            case 'object':
                return in_array(get_class($payload), $context->getType()->getClasses());

            default:
                return false;
        }
    }
}
