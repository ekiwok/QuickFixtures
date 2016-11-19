<?php

namespace spec\Ekiwok\QuickFixtures;

use Ekiwok\QuickFixtures\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Generator::class);
    }
}
