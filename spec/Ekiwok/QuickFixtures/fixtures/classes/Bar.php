<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

class Bar extends Foo
{
    /** @var string */
    private $bar;

    /**
     * @return string
     */
    public function getBar()
    {
        return $this->bar;
    }
}
