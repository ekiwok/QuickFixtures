<?php

namespace Ekiwok\QuickFixtures\Examples\PropertyPath\Model;

class Order
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @param Customer $customer
     * @param \DateTime $createdAt
     */
    public function __construct(Customer $customer, \DateTime $createdAt)
    {
        $this->customer = $customer;
        $this->createdAt = $createdAt;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
