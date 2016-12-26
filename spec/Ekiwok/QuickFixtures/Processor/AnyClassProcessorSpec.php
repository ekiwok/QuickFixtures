<?php

namespace spec\Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context\Path;
use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;
use Ekiwok\QuickFixtures\Factory\TypeFactory;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Model\ClassDetailsRegistry;
use Ekiwok\QuickFixtures\Provider\ClassDetailsProvider;
use PhpSpec\ObjectBehavior;
use Ekiwok\QuickFixtures\Processor\AnyClassProcessor;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bar;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bizz;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Foo;
use spec\Ekiwok\QuickFixtures\Processor\AnyClassProcessorSpec\BarGeneratorStub;

class AnyClassProcessorSpec extends ObjectBehavior
{
    function let()
    {
        $classDetailsProvider = new ClassDetailsProvider(
            new ClassDetailsFactory(new TypeFactory(), new ClassDetailsFactory\UseStatementsProvider()),
            new ClassDetailsRegistry()
        );

        $this->beConstructedWith($classDetailsProvider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AnyClassProcessor::class);
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

    function it_processes_bar_simple_class_with_single_string_property(ContextInterface $context)
    {
        $type = new Type([Bar::class]);
        $context->getType()->willReturn($type);
        $context->getPath()->willReturn(new Path());

        $bar = $this->process($context, ['bar' => 'test'], new BarGeneratorStub());

        $bar->getBar()->shouldBe('test');
    }

    function it_processes_complex_class_with_traits(
        ContextInterface $context,
        \DateTime $createdAt,
        \DateTime $updatedAt,
        Nested $nested
    ) {
        $type = new Type([Bizz::class]);
        $context->getType()->willReturn($type);
        $context->getPath()->willReturn(new Path());

        $payload = [
            'createdAt' => $createdAt,
            'updatedAt' => $updatedAt,
            'bar' => 'test',
            'nested' => $nested,
        ];

        $bizz = $this->process($context, $payload, new BarGeneratorStub());

        $bizz->getCreatedAt()->shouldBe($createdAt);
        $bizz->getUpdatedAt()->shouldBe($updatedAt);
        $bizz->getBar()->shouldBe('test');
        $bizz->getNested()->shouldBe($nested);
    }
}