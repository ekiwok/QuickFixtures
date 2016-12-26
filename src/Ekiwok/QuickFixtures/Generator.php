<?php

namespace Ekiwok\QuickFixtures;

use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Generator\UnsupportedContextException;
use Ekiwok\QuickFixtures\Processor\PrioritisedProcessorInterface;
use Ekiwok\QuickFixtures\Processor\ProcessorInterface;

class Generator implements GeneratorInterface
{
    const DEFAULT_PROCESSOR_PRIORITY = 0;

    /**
     * @var array
     */
    private $processors = [];

    /**
     * {@inheritdoc}
     */
    public function generate($context, $payload = null)
    {
        $context = $this->figureOutContext($context);

        /** @var ProcessorInterface[] $samePriorityProcessors */
        foreach ($this->processors as $samePriorityProcessors) {
            foreach ($samePriorityProcessors as $processor) {
                if ($processor->applies($context, $payload)) {
                    return $processor->process($context, $payload, $this);
                }
            }
        }

        throw new UnsupportedContextException(self::class, $context->getPath());
    }

    /**
     * @param ProcessorInterface $processor
     */
    public function addProcessor(ProcessorInterface $processor)
    {
        $priority = ($processor instanceof PrioritisedProcessorInterface)
            ? $processor->getPriority()
            : self::DEFAULT_PROCESSOR_PRIORITY;

        if (!array_key_exists($priority, $this->processors)) {
             $this->processors[$priority] = [];
        }

        $this->processors[$priority][] = $processor;

        krsort($this->processors);
    }

    /**
     * @param $context
     *
     * @throws UnsupportedContextException
     *
     * @return Context
     **/
    private function figureOutContext($context)
    {
        if (is_object($context)) {
            switch (true)
            {
                case $context instanceof Context:
                    return $context;

                default:
                    throw new UnsupportedContextException(get_class($this), get_class($context));
            }
        }

        $type = gettype($context);
        if ($type !== 'string') {
            throw new UnsupportedContextException(get_class($this), $type);
        }

        if (!class_exists($context)) {
            throw new UnsupportedContextException(get_class($this), $type);
        }

        return new Context(new Type([$context]));
    }
}
