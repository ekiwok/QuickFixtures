<?php

namespace spec\Ekiwok\QuickFixtures\Model;

use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\ClassDetailsRegistry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Foo;

class ClassDetailsRegistrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ClassDetailsRegistry::class);
    }

    function it_should_register_foo(ClassDetails $foo)
    {
        $foo->getName()->willReturn(Foo::class);

        $this->register($foo);

        $this->get(Foo::class)->shouldBe($foo);
    }

    function it_should_throw_runtime_exception_when_getting_unregistered_class_details()
    {
        $this->has(Foo::class)->shouldBe(false);

        $this->shouldThrow(\RuntimeException::class)
            ->duringGet(Foo::class);
    }

    function it_should_override_existing_class_details_when_registering_again(
        ClassDetails $firstFoo,
        ClassDetails $secondFoo
    ) {
        $firstFoo->getName()->willReturn(Foo::class);
        $secondFoo->getName()->willReturn(Foo::class);

        $this->register($firstFoo);
        $this->register($secondFoo);

        $this->has(Foo::class);

        $this->get(Foo::class)->shouldBe($secondFoo);
    }
}