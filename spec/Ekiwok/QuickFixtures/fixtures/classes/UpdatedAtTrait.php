<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

trait UpdatedAtTrait
{
    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
