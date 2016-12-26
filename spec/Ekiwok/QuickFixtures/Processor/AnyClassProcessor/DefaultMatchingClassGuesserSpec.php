<?php

namespace spec\Ekiwok\QuickFixtures\Processor\AnyClassProcessor;

use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\PropertyDetails;
use Ekiwok\QuickFixtures\Processor\AnyClassProcessor\DefaultMatchingClassGuesser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultMatchingClassGuesserSpec extends ObjectBehavior
{
    function it_is_initializabe()
    {
        $this->shouldBeAnInstanceOf(DefaultMatchingClassGuesser::class);
    }

    function it_returns_given_class_details_if_these_are_only_one_given(ClassDetails $classDetails)
    {
        $properties = ['foo', 'bar'];

        $this->guessClass([$classDetails], $properties)->shouldBe($classDetails);
    }

    function it_returns_first_class_details_given_if_no_parameters_are_present(
        ClassDetails $first,
        ClassDetails $second
    ) {
        $properties = [];
        $classesDetails = [$first, $second];

        $this->guessClass($classesDetails, $properties)->shouldBe($first);
    }

    function it_returns_class_that_has_more_matching_properties(
        ClassDetails $first,
        ClassDetails $second,
        PropertyDetails $property
    ) {
        $properties = ['foo', 'bar', 'bizz'];
        $classesDetails = [$first, $second];

        $first->getProperties()->willReturn(['bar' => $property]);
        $second->getProperties()->willReturn(['foo' => $property, 'bizz' => $property]);

        $this->guessClass($classesDetails, $properties)->shouldBe($second);
    }
}
