<?php

namespace spec\Ekiwok\QuickFixtures\Provider;

use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;
use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\ClassDetailsRegistry;
use Ekiwok\QuickFixtures\Provider\ClassDetailsProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassDetailsProviderSpec extends ObjectBehavior
{
    function it_is_initializable(ClassDetailsFactory $factory, ClassDetailsRegistry $registry)
    {
        $this->beConstructedWith($factory, $registry);

        $this->shouldHaveType(ClassDetailsProvider::class);
    }

    function it_registers_class_after_creation_by_factory(ClassDetailsFactory $factory, ClassDetails $classDetails)
    {
        $bizz = 'Foo\\Bar\\Bizz';

        $classDetails->getName()->willReturn($bizz);
        $factory->create($bizz)->willReturn($classDetails, null);

        $this->beConstructedWith($factory, new ClassDetailsRegistry());

        $this->getDetailsFor($bizz)->shouldReturn($classDetails);
        $this->getDetailsFor($bizz)->shouldReturn($classDetails);
    }

    function it_returns_registered_class(
        ClassDetailsFactory $factory,
        ClassDetailsRegistry $registry,
        ClassDetails $classDetails
    ) {
        $bizz = 'Foo\\Bar\\Bizz';

        $registry->has($bizz)->willReturn(true);
        $registry->get($bizz)->willReturn($classDetails);

        $this->beConstructedWith($factory, $registry);

        $this->getDetailsFor($bizz)->shouldReturn($classDetails);
    }
}
