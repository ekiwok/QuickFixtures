<?php

namespace spec\Ekiwok\QuickFixtures\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Factory\TypeFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bar;

class TypeFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TypeFactory::class);
    }

    function it_returns_bar_property_bar_string_type()
    {
        $property = new \ReflectionProperty(Bar::class, 'bar');

        /** @var Type $type */
        $type = $this->create($property, []);

        $type->getClasses()->shouldBeLike([]);
        $type->getScalars()->shouldBeLike(['string']);
    }
}
