<?php

declare(strict_types=1);

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class Credit
{
    /**
     * @var UUID
     */
    private $uuid;

    /**
     * @var float
     */
    private $ammount;

    /**
     * @var \DateTime
     */
    private $createdAt;

    public function __construct(UUID $uuid, \DateTime $createdAt, float $ammount)
    {
        $this->uuid = $uuid;
        $this->ammount = $ammount;
        $this->createdAt = $createdAt;
    }

    public function getAmmount() : int
    {
        return $this->ammount;
    }

    public function getUuid() : UUID
    {
        return $this->uuid;
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }
}
