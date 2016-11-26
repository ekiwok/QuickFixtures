<?php

namespace spec\Ekiwok\QuickFixtures\Context;

use Ekiwok\QuickFixtures\Context\Exception\EmptyPathException;
use Ekiwok\QuickFixtures\Context\Path;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PathSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Path::class);
    }

    function it_should_be_empty_after_initialization()
    {
        $this->getPath()->shouldBe([]);
        $this->__toSTring()->shouldBe('');
    }

    function it_should_throw_EmptyPathException_when_empty()
    {
        $this->shouldThrow(EmptyPathException::class)
            ->duringPop();
    }

    function it_should_correctly_build_path()
    {
        $this->push('foo');
        $this->push('bar');
        $this->push('bizz');

        $this->getPath()->shouldBe(['foo', 'bar', 'bizz']);
        $this->__toString()->shouldBe('foo.bar.bizz');
    }

    function it_should_correctly_build_path_and_rewind()
    {
        $this->push('foo');
        $this->push('bar');
        $this->push('bizz');
        $this->pop();
        $this->pop();

        $this->getPath()->shouldBe(['foo']);
        $this->__toString()->shouldBe('foo');
    }
}
