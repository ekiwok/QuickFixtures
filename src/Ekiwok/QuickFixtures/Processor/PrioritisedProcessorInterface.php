<?php

namespace Ekiwok\QuickFixtures\Processor;

interface PrioritisedProcessorInterface extends ProcessorInterface
{
    const BUILT_IN_PROCESSORS_PRIORITIES = [
        AbstractPathProcessor::class        => 1024,
        TypedArraysProcessor::class         => 255,
        AnyClassProcessor::class            => 0,
        ScalarProcessor::class              => -255,
        SinglePropertyClassProcessor::class => -1024,
    ];

    /**
     * @return int
     */
    public function getPriority();
}
