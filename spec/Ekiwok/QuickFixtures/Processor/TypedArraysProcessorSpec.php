<?php

namespace spec\Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context;
use Ekiwok\QuickFixtures\Context\Path;
use Ekiwok\QuickFixtures\Context\PathInterface;
use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Context\TypeInterface;
use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Model\Primitives;
use Ekiwok\QuickFixtures\Processor\TypedArraysProcessor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TypedArraysProcessorSpec extends ObjectBehavior
{
    function it_is_initialisable()
    {
        $this->shouldBeAnInstanceOf(TypedArraysProcessor::class);
    }

    function it_applies_to_scalar_types(ContextInterface $context, TypeInterface $type, TypeInterface $scalar)
    {
        $scalar->getScalars()->willReturn([Primitives::INTEGER]);
        $type->getTypedArrays()->willReturn([$scalar]);
        $context->getType()->willReturn($type);

        $this->applies($context, [])->shouldBe(true);
    }

    function it_applies_to_class_types(ContextInterface $context, TypeInterface $type, TypeInterface $class)
    {
        $class->getClasses()->willReturn([\DateTime::class]);
        $type->getTypedArrays()->willReturn([$class]);
        $context->getType()->willReturn($type);

        $this->applies($context, [])->shouldBe(true);
    }

    function it_processes_array_of_type_integer(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $scalarType = new Type([], [Primitives::INTEGER]);
        $type = new Type([], [], [$scalarType]);
        $path = new Path();
        $context->getType()->willReturn($type);
        $context->getPath()->willReturn($path);

        $payload = [3,4,5];

        $generator->generate(new Context($scalarType, $path), 3)->willReturn(3);
        $generator->generate(new Context($scalarType, $path), 4)->willReturn(4);
        $generator->generate(new Context($scalarType, $path), 5)->willReturn(5);

        $this->process($context, $payload, $generator)->shouldBe([3,4,5]);
    }
}
