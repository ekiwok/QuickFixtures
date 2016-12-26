<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

trait CreatedAtTrait
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
