<?php

namespace spec\Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use PhpSpec\ObjectBehavior;
use Ekiwok\QuickFixtures\Processor\UndefinedClassProcessor;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Foo;

class UndefinedClassProcessorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UndefinedClassProcessor::class);
    }

    function it_applies_to_Foo(ContextInterface $context)
    {
        $this->applies($context, [])->shouldBe(new Foo());
    }
}