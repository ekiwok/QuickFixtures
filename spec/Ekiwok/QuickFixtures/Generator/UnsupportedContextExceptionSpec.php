<?php

namespace spec\Ekiwok\QuickFixtures\Generator;

use Ekiwok\QuickFixtures\Generator\UnsupportedContextException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnsupportedContextExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('Generator', 'Context');

        $this->shouldBeAnInstanceOf(UnsupportedContextException::class);
    }
}