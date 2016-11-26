<?php

namespace spec\Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
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
        $type = new Type([Foo::class]);
        $context->getType()->willReturn($type);

        $this->applies($context, [])->shouldBe(true);
        $this->applies($context, new Foo(null))->shouldBe(true);
        $this->applies($context, null)->shouldBe(true);
    }

    function it_processes_foo_from_foo(ContextInterface $context, GeneratorInterface $generator)
    {
        $type = new Type([Foo::class]);
        $context->getType()->willReturn($type);

        $this->process($context, new Foo(null), $generator)->shouldHaveType(Foo::class);
        $this->process($context, null, $generator)->shouldHaveType(Foo::class);
        $this->process($context, [], $generator)->shouldHaveType(Foo::class);
    }
}