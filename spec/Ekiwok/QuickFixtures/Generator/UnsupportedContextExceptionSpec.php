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

    function it_is_initializable_with_previous_exceptions(
        UnsupportedContextException $e1,
        UnsupportedContextException $e2,
        UnsupportedContextException $e3
    ) {
        $this->beConstructedWith('Generator', 'Context', $e1, $e2, $e3);

        $this->shouldBeAnInstanceOf(UnsupportedContextException::class);

        $this->getPreviousUnsupportedContextExceptions()->shouldHaveCount(3);
    }
}