<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class Money
{
    /**
     * @var string
     */
    private $money;

    /**
     * @param string $money
     */
    public function __construct($money)
    {
        $this->money = $money;
    }

    /**
     * @return string
     */
    public function getMoney()
    {
        return $this->money;
    }
}
