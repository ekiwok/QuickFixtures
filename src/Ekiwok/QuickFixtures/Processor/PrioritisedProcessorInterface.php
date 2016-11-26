<?php

namespace Ekiwok\QuickFixtures\Processor;

interface PrioritisedProcessorInterface extends ProcessorInterface
{
    /**
     * @return int
     */
    public function getPriority();
}
