<?php

namespace spec\Ekiwok\QuickFixtures\Context\Exception;

use Ekiwok\QuickFixtures\Context\Exception\EmptyPathException;
use PhpSpec\ObjectBehavior;

class EmptyPathExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyPathException::class);
    }
}