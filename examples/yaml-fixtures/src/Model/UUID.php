<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class UUID
{
    /**
     * @var string
     */
    private $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
