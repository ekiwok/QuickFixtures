<?php

namespace spec\Ekiwok\QuickFixtures\Model;

use Ekiwok\QuickFixtures\Model\ClassDetails;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassDetailsSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith('foo', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ClassDetails::class);
    }

    function it_has_properties()
    {
        $this->getProperties()->shouldBe([]);
    }

    function it_has_name()
    {
        $this->getName()->shouldBe('foo');
    }
}
