<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class Money
{
    /**
     * @var float
     */
    private $money;

    /**
     * @param float $money
     */
    public function __construct($money)
    {
        $this->money = $money;
    }

    /**
     * @return float
     */
    public function getMoney()
    {
        return $this->money;
    }
}
