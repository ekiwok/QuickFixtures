<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

class ExampleWithCollections
{
    /**
     * @var Bizz[]
     */
    private $bizzes = [];

    /**
     * @var int[]
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
