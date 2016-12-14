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

    function it_correctly_returns_bar_details_with_its_bar_string_property()
    {
        /** @var ClassDetails $details */
        $details = $this->create(Bar::class);

        $details->getName()->shouldBe(Bar::class);
        $details->getProperties()->shouldBe([
            new PropertyDetails(Bar::class, new Type([], ['string']), new \ReflectionProperty(Bar::class, 'bar'))
        ]);
    }
}
