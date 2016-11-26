<?php

namespace spec\Ekiwok\QuickFixtures\Context;

use Ekiwok\QuickFixtures\Context\Type;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Type::class);
    }

    function it_should_have_a_class()
    {
        $this->beConstructedWith(['\\DateTime']);

        $this->hasAnyClass()->shouldBe(true);
        $this->getClasses()->shouldBe(['\\DateTime']);
    }
}
