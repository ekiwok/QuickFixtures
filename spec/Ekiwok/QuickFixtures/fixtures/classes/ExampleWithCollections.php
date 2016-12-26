<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

class ExampleWithCollections
{
    /**
     * @var Bizz[]
     */
    private $bizzes = [];

    /**
     * @var float[]
     */
    private $numbers = [];

    /**
     * @return Bizz[]
     */
    public function getBizzes()
    {
        return $this->bizzes;
    }

    /**
     * @return int[]
     */
    public function getNumbers()
    {
        return $this->numbers;
    }
}
