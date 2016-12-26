<?php

namespace spec\Ekiwok\QuickFixtures\Processor\AnyClassProcessorSpec;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;

class BarGeneratorStub implements GeneratorInterface
{

    /**
     * {@inheritdoc}
     */
    public function generate($context, $payload = null)
    {
        return $payload;
    }
}
