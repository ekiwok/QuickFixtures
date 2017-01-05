<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class CreditCard
{
    /**
     * @var Money
     */
    private $credit;

    /**
     * @var Address
     */
    private $address;

    /**
     * @param Money $credit
     * @param Address $address
     */
    public function __construct(Money $credit, Address $address)
    {
        $this->credit = $credit;
        $this->address = $address;
    }

    /**
     * @return Money
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }
}
