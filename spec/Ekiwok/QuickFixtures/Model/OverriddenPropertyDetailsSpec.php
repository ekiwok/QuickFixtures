<?php

namespace spec\Ekiwok\QuickFixtures\Model;

use Ekiwok\QuickFixtures\Context\TypeInterface;
use Ekiwok\QuickFixtures\Model\OverriddenPropertyDetails;
use Ekiwok\QuickFixtures\Model\PropertyDetails;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OverriddenPropertyDetailsSpec extends ObjectBehavior
{
    function it_is_initializable_with_simple_property_details(
        PropertyDetails $baseProperty,
        PropertyDetails $overridingProperty
    ) {
        $this->beConstructedWith($baseProperty, $overridingProperty);

        $this->shouldHaveType(OverriddenPropertyDetails::class);
    }

    function it_is_initializable_with_overriden_property_details(
        PropertyDetails $somePreviousProperty,
        PropertyDetails $someOverrideOnPreviousProperty,
        OverriddenPropertyDetails $baseProperty,
        PropertyDetails $overridingProperty
    ) {
        $baseProperty->getProperties()->willReturn([$somePreviousProperty, $someOverrideOnPreviousProperty]);
        $this->beConstructedWith($baseProperty, $overridingProperty);

        $this->shouldHaveType(OverriddenPropertyDetails::class);
        $this->getProperties()->shouldHaveCount(3);

        $this->getProperties()->shouldBeLike([
            $somePreviousProperty,
            $someOverrideOnPreviousProperty,
            $overridingProperty]
        );
    }

    function it_should_behave_like_last_overriden_property(
        PropertyDetails $somePreviousProperty,
        PropertyDetails $someOverrideOnPreviousProperty,
        OverriddenPropertyDetails $baseProperty,
        PropertyDetails $overridingProperty,
        TypeInterface $type,
        \ReflectionProperty $reflectionProperty
    ) {
        $baseProperty->getProperties()->willReturn([$somePreviousProperty, $someOverrideOnPreviousProperty]);

        $overridingProperty->getName()->willReturn('foo');
        $overridingProperty->getType()->willReturn($type);
        $overridingProperty->getReflectionProperty()->willReturn($reflectionProperty);

        $this->beConstructedWith($baseProperty, $overridingProperty);

        $this->getName()->shouldBe('foo');
        $this->getType()->shouldBe($type);
        $this->getReflectionProperty()->shouldBe($reflectionProperty);
    }
}
