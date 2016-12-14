<?php

namespace spec\Ekiwok\QuickFixtures\Model;

use Ekiwok\QuickFixtures\Context\TypeInterface;
use Ekiwok\QuickFixtures\Model\PropertyDetails;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropertyDetailsSpec extends ObjectBehavior
{
    function let(TypeInterface $type, \ReflectionProperty $reflectionProperty)
    {
        $this->beConstructedWith('foo', $type, $reflectionProperty);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PropertyDetails::class);
    }

    function it_has_type()
    {
        $this->getType()->shouldBeAnInstanceOf(TypeInterface::class);
    }

    function it_has_name()
    {
        $this->getName()->shouldBe('foo');
    }

    function it_has_reflection_property()
    {
        $this->getReflectionProperty()->shouldBeAnInstanceOf(\ReflectionProperty::class);
    }
}
