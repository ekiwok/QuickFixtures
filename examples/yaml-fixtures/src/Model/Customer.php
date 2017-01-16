<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class Customer
{
    /**
     * @var UUID
     */
    private $uuid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var Credit[]
     */
    private $credits;
}
