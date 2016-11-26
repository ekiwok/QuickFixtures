<?php

namespace spec\Ekiwok\QuickFixtures;

use Ekiwok\QuickFixtures\Context;
use Ekiwok\QuickFixtures\Context\TypeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContextSpec extends ObjectBehavior
{
    function let(TypeInterface $type)
    {
        $this->beConstructedWith($type);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Context::class);
    }
}
