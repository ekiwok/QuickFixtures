<?php

namespace spec\Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Processor\UnsupportedPayloadException;
use PhpSpec\ObjectBehavior;

class UnsupportedPayloadExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnsupportedPayloadException::class);
    }

    function it_is_initializable_by_static_method()
    {
        $exception = $this::create('Foo', 'Bar');

        $exception->shouldHaveType(UnsupportedPayloadException::class);
    }
}