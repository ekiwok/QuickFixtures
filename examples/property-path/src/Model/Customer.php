<?php

namespace Ekiwok\QuickFixtures\Examples\PropertyPath\Model;

class Customer
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var \DateTime
     */
    private $joinedAt;

    /**
     * @param string $uuid
     * @param string $firstName
     * @param string $lastName
     * @param \DateTime $joinedAt
     */
    public function __construct($uuid, $firstName, $lastName, \DateTime $joinedAt)
    {
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->joinedAt = $joinedAt;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return \DateTime
     */
    public function getJoinedAt()
    {
        return $this->joinedAt;
    }
}
