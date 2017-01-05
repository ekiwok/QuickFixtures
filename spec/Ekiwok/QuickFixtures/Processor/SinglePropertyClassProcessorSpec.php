<?php

namespace spec\Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context;
use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Factory\TypeFactory;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\Primitives;
use Ekiwok\QuickFixtures\Model\PropertyDetails;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;
use Ekiwok\QuickFixtures\Processor\SinglePropertyClassProcessor;
use Ekiwok\QuickFixtures\Provider\ClassDetailsProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bar;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bizz;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Foo;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;

class SinglePropertyClassProcessorSpec extends ObjectBehavior
{
    function let(ClassDetailsProvider $classDetailsProvider)
    {
        $this->beConstructedWith($classDetailsProvider);

        $classDetailsProvider->getDetailsFor(Bar::class)->willReturn(
            new ClassDetails(Bar::class, [new PropertyDetails(
                'bar',
                new Type(/* $classes = */[], [Primitives::STRING]),
                new \ReflectionProperty(Bar::class, 'bar')
            )])
        );

        $classDetailsProvider->getDetailsFor(Foo::class)->willReturn(
            new ClassDetails(Foo::class, [])
        );

        $classDetailsProvider->getDetailsFor(Bizz::class)->willReturn(
            new ClassDetails(Bar::class, [
                new PropertyDetails(
                    'bar', new Type([], [Primitives::STRING]), new \ReflectionProperty(Bar::class, 'bar')
                ),
                new PropertyDetails(
                    'nested', new Type([Nested::class]), new \ReflectionProperty(Bizz::class, 'nested')
                ),
                new PropertyDetails(
                    'createdAt', new Type([Nested::class]), new \ReflectionProperty(Bizz::class, 'createdAt')
                ),
                new PropertyDetails(
                    'updatedAt', new Type([Nested::class]), new \ReflectionProperty(Bizz::class, 'updatedAt')
                ),
            ])
        );
    }

    function it_is_initializable(ClassDetailsProvider $classDetailsProvider)
    {
        $this->shouldHaveType(SinglePropertyClassProcessor::class);
    }

    function it_applies_to_bar_string_property_when_string_given(ClassDetailsProvider $classDetailsProvider)
    {
        $context = new Context(new Type([Bar::class]));

        $this->applies($context, 'some_string')->shouldBe(true);
    }

    function it_does_not_apply_to_bar_string_property_when_integer_given()
    {
        $context = new Context(new Type([Bar::class]));

        $this->applies($context, 3)->shouldBe(false);
    }

    function it_does_not_apply_to_foo_which_has_no_properties()
    {
        $context = new Context(new Type([Foo::class]));

        $this->applies($context, 'test')->shouldBe(false);
    }

    function it_does_not_apply_to_bizz_which_has_many_properties()
    {
        $context = new Context(new Type([Bizz::class]));

        $this->applies($context, 'test')->shouldBe(false);
    }

    function it_throws_exception_processing_foo_without_properties(GeneratorInterface $generator)
    {
        $context = new Context(new Type([Foo::class]));

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, 'test', $generator);
    }

    function it_throws_exception_processing_bizz_which_has_many_properties(GeneratorInterface $generator)
    {
        $context = new Context(new Type([Bizz::class]));

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, 'test', $generator);
    }

    function it_processes_bar_with_string_when_string_given_as_payload(GeneratorInterface $generator)
    {
        $context = new Context(new Type([Bar::class]));

        $bar = $this->process($context, 'test', $generator);

        $bar->getBar()->shouldBe('test');
    }

    function it_processes_bar_when_foo_and_bizz_also_given_in_context_but_not_having_single_property(
        GeneratorInterface $generator
    ) {
        $context = new Context(new Type([Foo::class, Bar::class, Bizz::class]));

        $this->process($context, 'test', $generator)->shouldHaveType(Bar::class);
    }
}
