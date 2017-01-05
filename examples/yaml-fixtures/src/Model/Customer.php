<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class Customer
{
    /**
     * @var Wallet
     */
    private $wallet;

    /**
     * @return Wallet
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @param Wallet $wallet
     */
    public function setWallet(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }
}
