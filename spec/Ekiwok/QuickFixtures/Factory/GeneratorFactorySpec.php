<?php

namespace spec\Ekiwok\QuickFixtures\Factory;

use Ekiwok\QuickFixtures\Factory\GeneratorFactory;
use Ekiwok\QuickFixtures\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GeneratorFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GeneratorFactory::class);
    }

    function it_creates_default_generator()
    {
        $this->create()->shouldHaveType(Generator::class);
    }
}
