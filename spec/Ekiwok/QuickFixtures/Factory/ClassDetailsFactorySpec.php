<?php

namespace spec\Ekiwok\QuickFixtures\Factory;

use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;
use Ekiwok\QuickFixtures\Factory\TypeFactory;
use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\PropertyDetails;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bar;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bizz;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Foo;

class ClassDetailsFactorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new TypeFactory());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ClassDetailsFactory::class);
    }

    function it_correctly_returns_foo_details()
    {
        /** @var ClassDetails $details */
        $details = $this->create(Foo::class);

        $details->getName()->shouldBe(Foo::class);
        $details->getProperties()->shouldBe([]);
    }

    function it_correctly_returns_details_of_simple_class_with_one_string_property()
    {
        /** @var ClassDetails $details */
        $details = $this->create(Bar::class);

        $details->getName()->shouldBe(Bar::class);

        $properties = $details->getProperties();

        $barProperty = $properties['bar'];
        $barProperty->getName()->shouldBe('bar');
        $barProperty->getType()->getScalars()->shouldBe(['string']);
        $barProperty->getReflectionProperty()->shouldHaveType(\ReflectionProperty::class);
    }

    function it_correctly_returns_details_of_complex_class_with_inheritance_and_traits()
    {
        /** @var ClassDetails $details */
        $details = $this->create(Bizz::class);

        $details->getName()->shouldBe(Bizz::class);

        $properties = $details->getProperties();
        $properties->shouldBeArray();
        $properties->shouldHaveCount(4);

        $properties['createdAt']->shouldHaveType(PropertyDetails::class);
        $properties['updatedAt']->shouldHaveType(PropertyDetails::class);
        $properties['bar']->shouldHaveType(PropertyDetails::class);

        $nested = $properties['nested'];
        $nested->shouldHaveType(PropertyDetails::class);

        $nestedType = $nested->getType();
        $nestedType->getClasses()->shouldBe(['\\' . Nested::class]);
    }
}
